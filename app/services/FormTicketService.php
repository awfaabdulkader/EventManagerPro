<?php
namespace App\Services;

use App\Http\Requests\FormTicketRequest;
use App\Models\FormTicket;
use App\Mail\InvitationMail;
use Illuminate\Support\Facades\Mail;

class FormTicketService
{
    public function store(FormTicketRequest $request)
    {
        $formTicket = FormTicket::create($request->validated());

        // Send email
        Mail::to($formTicket->email)->send(new InvitationMail($formTicket));

        return redirect()->route('thanks')->with('success', 'Inscription réussie!');
    }
}
