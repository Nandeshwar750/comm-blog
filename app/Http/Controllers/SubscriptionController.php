<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('subscriptions', 'email')->where('is_active', true),
            ],
        ]);

        $subscription = Subscription::create([
            'email' => $validated['email'],
            'is_active' => true,
            'verified_at' => now(), // You might want to add email verification later
        ]);

        return back()->with('success', 'Successfully subscribed to newsletter!');
    }

    public function unsubscribe(Request $request, Subscription $subscription)
    {
        $subscription->update(['is_active' => false]);

        return back()->with('success', 'Successfully unsubscribed from newsletter!');
    }
} 