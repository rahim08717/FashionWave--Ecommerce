<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\PurchaseItem;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;use Illuminate\Support\Facades\File;
use App\Models\Product; // The Product Model

class PurchasesController extends Controller
{

    public function index()
    {
        // Fetch all products, eager loading 'category' and 'brand' relationships
        $purchases = Purchase::latest()->get();

        return view('admin.purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource. (Create Form)
     */
    public function create()
    {

        $suppliers = Supplier::latest()->get();
        $products = Product::latest()->get();

        return view('admin.purchases.create', compact('suppliers', 'products'));
    }


    // app/Http/Controllers/Admin/PurchasesController.php (store method)

    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'supplier_id'     => 'required|integer',
            'invoice_number'  => 'required|string|max:255',
            'purchases_date'   => 'required|date',
            'notes'           => 'nullable|string|max:255',
            'total_amount'    => 'required|numeric',

            'product_id'      => 'required|array',
            'product_id.*'    => 'required|integer',

            'quantity'        => 'required|array',
            'quantity.*'      => 'required|numeric|min:1',

            'purchase_price'  => 'required|array',
            'purchase_price.*' => 'required|numeric|min:0',
        ]);

        // Store Purchase
        $purchase = Purchase::create([
            'supplier_id'    => $request->supplier_id,
            'invoice_number' => $request->invoice_number,
            'purchases_date' => $request->purchases_date,  // corrected
            'notes'          => $request->notes,
            'total_amount'   => $request->total_amount,
        ]);

        try {
            foreach ($request->product_id as $index => $productId) {

                $qty = $request->quantity[$index];
                $price = $request->purchase_price[$index];
                $subtotal = $qty * $price;

                // Save purchase items
                PurchaseItem::create([
                    'purchase_id'    => $purchase->id,
                    'product_id'     => $productId,
                    'quantity'       => $qty,
                    'purchase_price' => $price,
                    'subtotal'       => $subtotal,
                ]);

                // Insert stock
                Stock::create([
                    'reference_id'   => $purchase->id,
                    'reference_type' => 'purchase',
                    'product_id'     => $productId,
                    'quantity'       => $qty,
                    'stock_type'     => 'in',
                    'note'           => 'Stock added from purchase: ' . $purchase->invoice_number,
                ]);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return redirect()->route('admin.purchases.index')
            ->with('success', 'Purchase created successfully.');
    }

    /**
     * Show the form for editing the specified resource. (Edit Form)
     */
    public function edit($id)
    {
        $purchase = Purchase::with('items')->findOrFail($id);
        $product = Product::latest()->get();
        $suppliers = Supplier::latest()->get();

        return view('admin.purchases.edit', compact('product', 'purchase', 'suppliers'));
    }

    /**
     * Update the specified resource in storage. (Update)
     */
    public function update(Request $request, $id)
    {
        // 1. Validation (Same as before, ensuring array inputs are correct)
        $request->validate([
            'supplier_id'      => 'required|integer|exists:suppliers,id', // exists check যোগ করা হলো
            'invoice_number'   => 'required|string|max:255|unique:purchases,invoice_number,' . $id, // Unique check যোগ করা হলো (বর্তমান রেকর্ড বাদ দিয়ে)
            'purchases_date'   => 'required|date',
            'notes'            => 'nullable|string|max:255',
            'total_amount'     => 'required|numeric',

            'product_id'       => 'required|array',
            'product_id.*'     => 'required|integer|exists:products,id', // exists check যোগ করা হলো

            'quantity.*'       => 'required|numeric|min:1',
            'purchase_price.*' => 'required|numeric|min:0',
        ]);

        // Find Purchase
        $purchase = Purchase::findOrFail($id);

        // 2. Start Transaction
        DB::beginTransaction();

        try {
            // 3. Update Purchase main info
            $purchase->update([
                'supplier_id'    => $request->supplier_id,
                'invoice_number' => $request->invoice_number,
                'purchases_date' => $request->purchases_date,
                'notes'          => $request->notes,
                // 'total_amount' কে final update এ গণনা করা হবে, তবে প্রাথমিক ভাবে আপডেট করা যায়
                'total_amount'   => $request->total_amount,
            ]);

            // 4. Delete Old Items and Stock Entries

            // Delete old purchase items associated with this purchase
            PurchaseItem::where('purchase_id', $purchase->id)->delete();

            // Delete old stock entries related to this purchase
            Stock::where('reference_id', $purchase->id)
                ->where('reference_type', 'purchase')
                ->delete();

            // 5. Insert New Items + Stock
            $calculatedTotal = 0; // নতুন মোট মূল্য গণনার জন্য ভ্যারিয়েবল

            foreach ($request->product_id as $index => $productId) {

                $qty = $request->quantity[$index];
                $price = $request->purchase_price[$index];
                $subtotal = $qty * $price;

                // Create new purchase items
                PurchaseItem::create([
                    'purchase_id'    => $purchase->id,
                    'product_id'     => $productId,
                    'quantity'       => $qty,
                    'purchase_price' => $price,
                    'subtotal'       => $subtotal,
                ]);

                // Create new stock entry (stock-in)
                Stock::create([
                    'reference_id'   => $purchase->id,
                    'reference_type' => 'purchase',
                    'product_id'     => $productId,
                    'quantity'       => $qty,
                    'stock_type'     => 'in',
                    'note'           => 'Updated stock from purchase: ' . $purchase->invoice_number,
                ]);

                $calculatedTotal += $subtotal;
            }

            // 6. Final total update (using the calculated total)
            $purchase->update(['total_amount' => $calculatedTotal]);

            // 7. Commit Transaction (সবকিছু ঠিক থাকলে ডাটাবেসে সেভ হবে)
            DB::commit();

            return redirect()
                ->route('admin.purchases.index')
                ->with('success', 'Purchase updated successfully.');

        } catch (\Exception $e) {
            // 8. Rollback Transaction (কোনো ভুল হলে সব অপারেশন বাতিল)
            DB::rollBack();

            // Log the detailed error for debugging
            Log::error("Purchase update failed for ID: {$id}. Error: " . $e->getMessage());

            // Redirect with a generic error message
            return redirect()
                ->back()
                ->with('error', 'Purchase update failed. Please check your data and try again.')
                ->withInput();
        }
    }


    /**
     * Remove the specified resource from storage. (Delete/Destroy)
     */
    public function destroy($id)
    {
        // Find purchase record
        $purchase = Purchase::findOrFail($id);

        // Delete purchase items
        PurchaseItem::where('purchase_id', $purchase->id)->delete();

        // Delete stock records linked to this purchase
        Stock::where('reference_id', $purchase->id)
            ->where('reference_type', 'purchase')
            ->delete();

        // Finally delete purchase
        $purchase->delete();

        return redirect()
            ->route('admin.purchases.index')
            ->with('success', 'Purchase deleted successfully.');
    }
}
