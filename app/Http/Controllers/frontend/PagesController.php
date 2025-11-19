<?php

namespace App\Http\Controllers\frontend;
use DrewM\MailChimp\MailChimp;
use App\Models\Page;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PagesController extends Controller
{
    public function terms()
    {
        $data=Page::where('slug','terms-and-conditions')->first();

        return view('front.pages.terms',compact('data'));
    }

    public function faq()
    {
        $data=Page::where('slug','faq')->first();
        $faqs = DB::table('faqs')->get();

        return view('front.pages.faq',compact('data','faqs'));
    }


   public function about()
    {
        $data=Page::where('slug','about-us')->first();
        return view('front.pages.about',compact('data'));
    }
    public function contact()

    {
        $data=Page::where('slug','contact-us')->first();
        return view('front.pages.contact',compact('data'));
    }

    public function store(Request $request)
    {
        try {
            // Validation
            $request->validate([
                'firstname'     => 'required|string|max:100',
                'lastname'      => 'required|string|max:100',
                'contact_phone' => 'required|string|max:15',
                'email'         => 'required|email|max:100',
                'message'       => 'required|string|max:500',
            ]);

            // ✅ Save to database
            DB::table('contacts')->insert([
                'firstname'     => $request->firstname,
                'lastname'      => $request->lastname,
                'contact_phone' => $request->contact_phone,
                'email'         => $request->email,
                'message'       => $request->message,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            // ✅ Mailchimp Integration (Direct env)
            $mailchimp = new MailChimp(env('MAILCHIMP_APIKEY'));
            $listId    = env('MAILCHIMP_LIST_ID');

            $result = $mailchimp->post("lists/{$listId}/members", [
                'email_address' => $request->email,
                'status'        => 'subscribed',
                'merge_fields'  => [
                    'FNAME' => $request->firstname,
                    'LNAME' => $request->lastname,
                ]
            ]);

            if ($mailchimp->success()) {
                return redirect()->back()->with('success', '✅ Your message has been sent and you are subscribed!');
            } else {
                Log::error('Mailchimp Error: '.$mailchimp->getLastError());
                return redirect()->back()->with('error', '⚠️ Saved sucessfully: '.$mailchimp->getLastError());
            }

        } catch (\Exception $e) {
            Log::error('Contact Store Exception: '.$e->getMessage(), ['email' => $request->email]);
            return redirect()->back()->with('error', '❌ Something went wrong. Please try again.');
        }
    }
    public function privacy()
    {
        $data=Page::where('slug','privacy-policy')->first();
        return view('front.pages.privacy',compact('data'));
    }
}
