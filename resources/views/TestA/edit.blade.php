<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    @vite(['resources/css/app.css'])
    <title>Document</title>
</head>
<body class="h-screen bg-center bg-cover" style="background-image: url('{{ asset('asset/images/background.png') }}');" >
    <div class="flex flex-col items-center min-h-screen">
        <div class="mt-8 w-60 h-36">
            <img src="{{asset('asset/images/logo.jpg')}}" alt="Centered Image" class="object-contain w-full h-full">
        </div>
        <div class="w-full max-w-xl p-4 mx-auto mb-12">
            <form class="p-8 rounded-lg shadow-lg bg-gray-50" action="{{ route('dashboard.guest.Update', $FormTicket->id) }}" method="POST">
                @csrf
                @method('PUT')
                <p class="mb-4 text-lg font-medium text-center">Bienvenue dans le formulaire d'inscription à l'événement Modern nest designs</p>
                <h6 class="text-xs text-center text-gray-700">Afin de vous inscrire, merci de compléter le formulaire ci-dessous. Vous recevrez un mail avec votre invitation</h6>
                <p class="mb-4 text-xs text-right text-red-600">*champs obligatoire</p>
                @if ($errors->any())
                <div class="p-4 mb-4 text-white bg-red-500 rounded-lg">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>

                    <ul>
                        @if(session('success'))
    <div class="bg-green-500 text-white p-3 rounded">
        {{ session('success') }}
    </div>
@endif

                    </ul>
                </div>
                @endif
                <div class="flex items-center gap-5 mb-6">
                    <p class="text-sm text-gray-700">Civilité <span class="text-red-600">*</span></p>
                    <div class="flex items-center gap-2">
                        <input type="radio" id="Madame" name="civility" value="Madame" class="mr-1" {{ old('civility', $FormTicket->civility) == 'Madame' ? 'checked' : '' }}>
                        <label for="Madame" class="text-sm">Madame</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="radio" id="Monsieur" name="civility" value="Monsieur" class="mr-1 form-control" {{ old('civility', $FormTicket->civility) == 'Monsieur' ? 'checked' : '' }}>
                        <label for="Monsieur" class="text-sm">Monsieur</label>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="firstName" class="block text-sm text-gray-700">Prénom <span class="text-red-600">*</span></label>
                    <input type="text" value="{{ old('firstName', $FormTicket->firstName) }}" id="firstName" name="firstName" class="w-full p-2 mb-1 border border-gray-300 rounded form-control rounded-2xl">
                </div>
                <div class="mb-4">
                    <label for="lastName" class="block text-sm text-gray-700">Nom <span class="text-red-600">*</span></label>
                    <input type="text" value="{{ old('lastName', $FormTicket->lastName) }}" id="lastName" name="lastName" class="w-full p-2 mb-1 border border-gray-300 rounded form-control rounded-2xl">
                </div>
                <div class="mb-4">
                    <label for="organization" class="block text-sm text-gray-700">Société/Organisation/Etablissement</label>
                    <input type="text" id="organization" name="organization" value="{{ old('organization', $FormTicket->organization) }}" class="w-full p-2 mb-1 border border-gray-300 rounded form-control rounded-2xl">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm text-gray-700">E-mail <span class="text-red-600">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', $FormTicket->email) }}" class="w-full p-2 border border-gray-300 rounded-2xl">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm text-gray-700">Téléphone <span class="text-red-600">*</span></label>
                    <input type="tel" value="{{ old('phone', $FormTicket->phone) }}" id="phone" name="phone" class="w-full p-2 mb-1 border border-gray-300 rounded form-control rounded-2xl">
                </div>
                <select id="job" name="job" class="w-full p-2 mb-1 border border-gray-300 rounded form-control rounded-2xl">
                    <option value="">-- Select a job --</option>
                    <option value="Architecture" {{ old('job', $FormTicket->job) == 'Architecture' ? 'selected' : '' }}>Architecture</option>
                    <option value="Civil Engineering" {{ old('job', $FormTicket->job) == 'Civil Engineering' ? 'selected' : '' }}>Civil Engineering</option>
                    <option value="BTP" {{ old('job', $FormTicket->job) == 'BTP' ? 'selected' : '' }}>BTP</option>
                    <option value="Architecture d-interieur" {{ old('job', $FormTicket->job) == 'Architecture d-interieur' ? 'selected' : '' }}>Architecture d'intérieur</option>
                    <option value="Urban Planning" {{ old('job', $FormTicket->job) == 'Urban Planning' ? 'selected' : '' }}>Urban Planning</option>
                </select>
                <button type="submit" class="w-40 h-8 text-white bg-orange-700 rounded-2xl">Update</button>
            </form>
        </div>
    </div>
    <script src="{{ asset('asset/js/phone.js') }}"></script>
</body>
</html>
