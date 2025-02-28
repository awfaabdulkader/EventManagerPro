<?php

namespace App\Traits;

use Log;
use App\Models\User;
use App\Models\FormTicket;
use App\Mail\InvitationMail;
use Illuminate\Support\Facades\Mail;
use App\Notifications\newGuestRegister;
use App\Http\Requests\FormTicketRequest;

trait FormTicketStoreTrait
{

    public function store(FormTicketRequest $request)
    {
        // Validate email
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return back()->withErrors(['email' => 'Adresse e-mail invalide.']);
        }

        // Validate phone number
        if (!preg_match('/^\+?[0-9]{8,15}$/', $request->phone)) {
            return back()->withErrors(['phone' => 'Numéro de téléphone invalide.']);
        }

        // Check if email already exists
        if (FormTicket::where('email', $request->email)->exists()) {
            return back()->withErrors(['email' => 'Cet e-mail est déjà utilisé.']);
        }

        // Create the guest entry with validated data
        $formTicket = FormTicket::create($request->validated());

        // Check if formTicket is created successfully
        if (!$formTicket) {
            return back()->withErrors(['error' => 'Failed to create FormTicket.']);
        }

        // Find the first admin user
        $admin = User::first();

        if (!$admin) {
            Log::error("Admin user not found.");
            return back()->withErrors(['error' => 'No admin user found.']);
        }

        // Notify the admin
        $admin->notify(new newGuestRegister($formTicket));
        dd("Notification sent!");
        
        // Send email to the user
        if (!empty($formTicket->email)) {
            Mail::to($formTicket->email)->send(new InvitationMail($formTicket));
        } else {
            Log::error("FormTicket email is missing.");
            return back()->withErrors(['error' => 'No email found for the guest.']);
        }

        return redirect()->route('thanks')->with('success', 'Inscription réussie!');
    }
}
