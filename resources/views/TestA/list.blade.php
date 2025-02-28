@extends('layouts.headerapp')

@section('content')

@if(session('success'))
    <div id="successMessage" class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-500 text-white p-3 rounded shadow-lg transition-opacity duration-500">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="p-4 mb-4 text-white bg-red-500 rounded-lg">
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="px-4 pb-6">

    <div class="relative overflow-x-auto flex justify-center flex-col items-center min-h-screen   sm:rounded-lg">
        
<div class="flex flex-wrap justify-between gap-4 m-4">
    <button
        class="relative h-[50px] w-40 overflow-hidden border border-green-900 bg-white text-green-900
        shadow-2xl transition-all before:absolute before:left-0 before:right-0 before:top-0 before:h-0 
        before:w-full before:bg-green-900 before:duration-500 after:absolute after:bottom-0 after:left-0 
        after:right-0 after:h-0 after:w-full after:bg-green-900 after:duration-500 hover:text-white hover:shadow-green-900 
        hover:before:h-2/4 hover:after:h-2/4  ">
        <a href="{{ route('export.new_pdf') }}" class="relative z-10">Download PDF</a>
    </button>

    <button
        class="group relative min-h-[50px] w-40 overflow-hidden border border-purple-500 bg-white text-purple-500 shadow-2xl transition-all before:absolute before:left-0 before:top-0 before:h-0 before:w-1/4 before:bg-purple-500 before:duration-500 after:absolute after:bottom-0 after:right-0 after:h-0 after:w-1/4 after:bg-purple-500 after:duration-500 hover:text-white hover:before:h-full hover:after:h-full">
        <span
            class="top-0 flex h-full w-full items-center justify-center before:absolute before:bottom-0 before:left-1/4 before:z-0 before:h-0 before:w-1/4 before:bg-purple-500 before:duration-500 after:absolute after:right-1/4 after:top-0 after:z-0 after:h-0 after:w-1/4 after:bg-purple-500 after:duration-500 hover:text-white group-hover:before:h-full group-hover:after:h-full"></span>
        <a href="{{ route('export.new_csv') }}" class="absolute bottom-0 left-0 right-0 top-0 z-10 flex h-full w-full items-center justify-center group-hover:text-white">Download CSV</a>
    </button>
</div>
        <div class="block w-full overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-300">
                <thead class="text-xs uppercase bg-gray-800 sticky top-0">
                    <tr>
                        <th scope="col" class="px-3 py-2 text-gray-200">ID</th>
                        <th scope="col" class="px-3 py-2 text-gray-200">CIVILITY</th>
                        <th scope="col" class="px-3 py-2 text-gray-200">FIRSTNAME</th>
                        <th scope="col" class="px-3 py-2 text-gray-200">LASTNAME</th>
                        <th scope="col" class="px-3 py-2 text-gray-200 hidden md:table-cell">ORGANIZATION</th>
                        <th scope="col" class="px-3 py-2 text-gray-200 hidden md:table-cell">E-MAIL</th>
                        <th scope="col" class="px-3 py-2 text-gray-200">PHONE</th>
                        <th scope="col" class="px-3 py-2 text-gray-200 hidden lg:table-cell">JOB</th>
                        <th scope="col" class="px-3 py-2 text-gray-200">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b border-gray-700 bg-gray-900 hover:bg-gray-800">
                            <td class="px-3 py-2 text-gray-300">{{ $user->id }}</td>
                            <td class="px-3 py-2 text-gray-300">{{ $user->civility }}</td>
                            <td class="px-3 py-2 text-gray-300">{{ $user->firstName }}</td>
                            <td class="px-3 py-2 text-gray-300">{{ $user->lastName }}</td>
                            <td class="px-3 py-2 text-gray-300 hidden md:table-cell">{{ $user->organization }}</td>
                            <td class="px-3 py-2 text-gray-300 hidden md:table-cell">{{ $user->email }}</td>
                            <td class="px-3 py-2 text-gray-300">{{ $user->phone }}</td>
                            <td class="px-3 py-2 text-gray-300 hidden lg:table-cell">{{ $user->job }}</td>
                            <td class="px-3 py-2">
                                <div class="flex flex-wrap gap-1">
                                    <a  href="{{ route('dashboard.guest.edit', $user->id) }}"  class="px-2 py-1 text-xs text-white bg-blue-500 rounded hover:bg-blue-600">Edit</a>
                                    <form action="{{route( 'dashboard.guest.destroy', $user->id)}}"   method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 text-xs text-white bg-red-500 rounded hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                   
                </tbody>
            </table>
           
{{ $users->links() }}
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            let successMessage = document.getElementById("successMessage");
            if (successMessage) {
                successMessage.style.opacity = "0";
                setTimeout(() => successMessage.style.display = "none", 500);
            }
        }, 1000); // Hide after 3 seconds
    });
</script>

@endsection