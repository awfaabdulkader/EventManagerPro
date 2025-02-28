<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'civility'=>'required|in:Madame,Monsieur',
            'firstName'=>'required|string|max:255',
            'lastName'=>'required|string|max:255',
            'organization'=>'nullable|string|max:255',
            'email'=>'required|email:rfc,dns|max:255|unique:users,email', //rfc: Ensures the email follows proper RFC formatting rules.  dns: Checks if the domain actually exists (e.g., if gmail.c is not a real domain, it will fail).
            'phone'=> 'required |regex:/^\+?[0-9]{8,15}$/',
            'job' => 'required|string|max:255'
        ];
    }



    public function messages()
    {
        return
        [
            'civility.required' => 'Veuillez sélectionner votre civilité.',
            'firstName.required' => 'Le prénom est requis.',
            'lastName.required' => 'Le nom est requis.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'Veuillez entrer une adresse e-mail valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'phone.regex' => 'Le numéro de téléphone doit contenir entre 8 et 15 chiffres.',
            'job.required' => 'Veuillez sélectionner votre intérêt pour l\'événement.',
        ];
    }
}
