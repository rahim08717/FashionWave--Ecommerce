<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DrewM\MailChimp\MailChimp;

class SubscribeController extends Controller
{
    public function store(Request $request)
    {
        try {
            // ✅ Validate email
            $request->validate([
                'email' => 'required|email|unique:subscribes,email',
            ]);

            // ✅ Save subscriber in local database
            $subscriber = Subscribe::create([
                'email' => $request->email,
            ]);

            // ✅ Mailchimp API setup (direct from .env)
            $mailchimp = new MailChimp(env('MAILCHIMP_APIKEY'));
            $listId    = env('MAILCHIMP_LIST_ID');

            $response = $mailchimp->post("lists/{$listId}/members", [
                'email_address' => $request->email,
                'status'        => 'subscribed', // 'pending' দিলে double opt-in হবে
            ]);

            // ✅ Check Mailchimp response
            if ($mailchimp->success()) {
                return back()->with('success', '✅ Subscribed successfully & added to Mailchimp!');
            } else {
                Log::error('Mailchimp Error: '.$mailchimp->getLastError(), [
                    'email' => $request->email,
                    'response' => $response
                ]);
                return back()->with('warning', '⚠️ Saved locally, but Mailchimp failed. Please check later.');
            }

        } catch (\Exception $e) {
            Log::error('Subscribe Exception: '.$e->getMessage(), [
                'email' => $request->email ?? null,
            ]);
            return back()->with('error', '❌ Something went wrong. Please try again.');
        }
    }
}
