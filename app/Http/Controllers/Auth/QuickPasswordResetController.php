<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class QuickPasswordResetController extends Controller
{
    /**
     * Handle the quick password reset request.
     */
    public function reset(Request $request): RedirectResponse
    {
        // Validate the request
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Find the user by email
        $user = User::where('email', $validated['email'])->first();

        if (! $user) {
            return back()->withErrors(['email' => 'No account found with this email address.']);
        }

        // Update the password
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'Password reset successfully! You can now login with your new password.');
    }
}
