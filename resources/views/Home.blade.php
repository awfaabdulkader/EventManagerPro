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
        <!-- Logo section -->
        <div class="mt-8 w-60 h-36">
            <img src="{{asset('asset/images/logo.jpg')}}" alt="Centered Image" class="object-contain w-full h-full">
        </div>

        <!-- Form section -->
        <div class="w-full max-w-xl p-4 mx-auto mb-12">
            <form class="p-8  rounded-lg shadow-lg bg-gray-50 " action="{{ route('Guest.store') }}" method="POST" >
                @csrf
                <p class="mb-4 text-lg font-medium text-center">
                    Bienvenue dans le formulaire d'inscription à l'événement Modern nest designs
                </p>
                <h6 class="text-xs text-center text-gray-700">
                    Afin de vous inscrire. merci de compléter le formulaire ci dessous.Vous recervez un mail avec votre invitation
                </h6>
                <p class="mb-4 text-xs text-right text-red-600">*champs obligatoire</p>
                @if ($errors->any())
                <div class="p-4 mb-4 text-white bg-red-500 rounded-lg">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                <div class="flex items-center gap-5 mb-6 ">
                <p class="text-sm text-gray-700"> Civilité <span class="text-red-600">*</span> </p>
                <div class="flex items-center gap-2">
                    <input type="radio" id="Madame" name="civility" value="Madame" class="mr-1 "  {{ old('civility') == 'Madame' ? 'checked' : '' }}>
                    <label for="Madame" class="text-sm">Madame</label>
                </div>
                <div class="flex items-center gap-2">
                    <input type="radio" id="Monsieur" name="civility" value="Monsieur" class="mr-1 form-control" {{ old('civility') == 'Monsieur' ? 'checked' : '' }}>
                    <label for="Monsieur" class="text-sm">Monsieur</label>
                </div>
                @error('civility')
                <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
                </div>

                <div class="mb-4">
                    <label for="firstName" class="block text-sm text-gray-700">Prénom  <span class="text-red-600">*</span></label>
                    <input type="text" value="{{ old('firstName') }}" id="firstName" name="firstName" class="w-full p-2 mb-1 border border-gray-300 rounded form-control rounded-2xl">
                    @error('firstName')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
                </div>

                <div class="mb-4">
                    <label for="lastName" class="block text-sm text-gray-700">Nom <span class="text-red-600">*</span></label>
                    <input type="text" value="{{ old('lastName') }}" id="lastName" name="lastName" class="w-full p-2 mb-1 border border-gray-300 rounded form-control rounded-2xl">

                    @error('lastName')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror

                </div>

                <div class="mb-4">
                    <label for="organization" class="block text-sm text-gray-700">Société/Organisation/Etablissement </label>
                    <input type="text" id="organization" name="organization" class="w-full p-2 mb-1 border border-gray-300 rounded form-control rounded-2xl">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm text-gray-700">E-mail <span class="text-red-600">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full p-2 border border-gray-300 rounded-2xl">
                    @error('email')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-sm text-gray-700">Téléphone  <span class="text-red-600">*</span></label>
                    <input type="tel"   value="{{ old('phone') }}"  id="phone" name="phone" class="w-full p-2 mb-1 border border-gray-300 rounded form-control rounded-2xl">

                    @error('phone')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
                </div>

                <select id="job" name="job" class="w-full p-2 mb-1 border border-gray-300 rounded form-control rounded-2xl">
                    <option value="">-- Select an job --</option>
                    <option value="Architecture" {{ old('job') == 'Architecture' ? 'selected' : '' }}>Architecture</option>
                    <option value="Civil Engineering" {{ old('job') == 'Civil Engineering' ? 'selected' : '' }}>Civil Engineering</option>
                    <option value="BTP" {{ old('job') == 'BTP' ? 'selected' : '' }}>BTP</option>
                    <option value="Architecture d-interieur" {{ old('job') == 'Architecture d-interieur' ? 'selected' : '' }}>Architecture d'intérieur</option>
                    <option value="Urban Planning" {{ old('job') == 'Urban Planning' ? 'selected' : '' }}>Urban Planning</option>
                </select>
                
                <button  type="submit" class="w-40 h-8 text-white bg-orange-700 rounded-2xl">S'inscrire</button>
        </form>
        </div>
    </div>

    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 z-50 flex items-center justify-center bg-white">
        <img id="loadingGif" src="{{ asset('asset/Iphone-spinner-2.gif') }}?v={{ time() }}" alt="Loading..." class="w-20 h-20">
    </div>

    <script>
        // Set a minimum load time of 5 seconds
        let minLoadTime = 2000; // 5 seconds
        let startTime = Date.now();

        window.addEventListener("load", function() {
            let elapsedTime = Date.now() - startTime;
            let remainingTime = minLoadTime - elapsedTime;

            // Ensure preloader stays at least 5 sec, but stays longer if needed
            setTimeout(() => {
                document.getElementById("preloader").style.display = "none";
            }, remainingTime > 0 ? remainingTime : 0);
        });
    </script>

    <script src="{{asset('asset/js/phone.js')}}"></script>
</body>
</html>
