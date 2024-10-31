<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscountController extends Controller
{
    // Method to claim a discount based on the brand
    public function claim($brand)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user has achieved their goal for the brand
        // Assuming you have a method to check if the user has met their goal
        $goal = $user->goals()->where('brand', $brand)->first();

        if (!$goal || $goal->actual_hours < $goal->target_hours) {
            return redirect()->back()->with('error', 'You must achieve your goal before claiming a discount.');
        }

        // Logic to redeem the discount
        // For example, update a database field to mark the discount as claimed
        // You may want to have a Discount model and handle that logic accordingly
        // Example:
        // $discount = new Discount();
        // $discount->user_id = $user->id;
        // $discount->brand = $brand;
        // $discount->claimed_at = now();
        // $discount->save();

        // Optionally, send an email or notification about the discount
        // Mail::to($user->email)->send(new DiscountClaimed($brand));

        return redirect()->back()->with('success', 'Discount claimed successfully for ' . $brand . '!');
    }
}