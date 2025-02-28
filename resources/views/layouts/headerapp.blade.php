<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
        @vite(['resources/css/app.css'])
        <title>Document</title>
    </head>
    
<body class="bg-[#f5ead6] min-h-screen flex flex-col ">
    <div class="flex flex-1">
        @include('components.admin.sidebar')
        <main class="flex-1">
            @yield('content')
        </main>
    </div>
    <footer  class="mt-auto py-4 text-center">
        <p>&copy; {{ date('Y') }} My Website</p>

    </footer>
    <script src="{{asset('asset/js/sidebar.js')}}"></script>
    <script src="https://kit.fontawesome.com/4d4bf601ed.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('asset/js/demographics.js') }}"></script>

</body>
</html>
