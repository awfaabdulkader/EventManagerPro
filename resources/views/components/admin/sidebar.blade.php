

    <!-- Left Sidebar - Changes width based on state -->
    <div id="sidebar" class="bg-white min-h-screen border-r border-gray-200 transition-all duration-300 flex flex-col overflow-hidden w-[88px] lg:sticky lg:top-0 fixed top-0 left-0 z-50 h-full">
        <!-- Logo area -->
        
        <div class="py-4 px-4 flex items-center justify-center">
            <div id="collapsedLogo" class="block">
                <div class="w-14 h-14 rounded-md bg-[#f5f5f4] flex items-center justify-center border border-gray-200">
                    <span class="text-2xl font-bold text-[#3b3936]">EK</span>
                </div>
            </div>
            <div id="expandedLogo" class="hidden">
                <div class="flex items-center z-10">
                     <div class="w-10 h-10 rounded-md bg-[#f5f5f4] flex items-center justify-center border border-gray-200">
                        <span class="text-xl font-bold text-[#3b3936]">EK</span>
                    </div>
                    <span class="text-lg font-bold text-stone-400 mr-2">Nestdesign</span>
                   
                </div>
            </div>
        </div>
        
        <!-- Navigation Header - Only visible when expanded -->
        <div id="navHeader" class="hidden px-4 py-2 text-xs text-gray-500 font-medium mt-4">
            MENU DE NAVIGATION
        </div>
        
        <!-- Navigation Links -->
        <nav class="mt-8 flex flex-col">
            <!-- Dashboard Link -->
            <a href="{{route('dashboard')}}" class="flex items-center py-3 px-4 text-gray-500 hover:text-gray-800 group">
                <div class="w-8 flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <span id="dashboardText" class="hidden ml-3 font-medium">Tableau de Bord</span>
            </a>
            
            <!-- Add Product Link -->
            <a href="{{ route('dashboard.guest.create') }}"  class="flex items-center py-3 px-4 text-gray-500 hover:text-gray-800 group">
                <div class="w-8 flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>
                <span id="productText" class="hidden ml-3 font-medium">Add guests</span>
            </a>

             <div class="relative">
                <button id="listButton" class="w-full flex items-center py-3 px-4 text-gray-500 hover:text-gray-800 group">
                    <div class="w-8 flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <span id="listText" class="hidden ml-3 font-medium">List guests</span>
                    <svg id="arrowIcon" xmlns="http://www.w3.org/2000/svg" class="hidden h-4 w-4 ml-auto transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
             </div>

             <!--Dropdown Menu-->
            <div id="ListDropdown" class="hidden  ml-12 py-2">
                <a href="{{route('dashboard/list')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Guests's information</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">List confirm</a>
            </div>
        </nav>
    </div>

     <!-- Main Content -->
     <div class="flex-1 flex flex-col">
        <!-- Top Bar -->
        <header class="px-8 py-4 bg-[#f5f5f4] shadow-md flex items-center justify-between ">
            <button id="sidebarToggle" class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div class="relative">
                <div id="notificationButton" class="flex items-center space-x-4">
                    <button class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center relative">
                        🔔
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span id="notificationCount" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </button>
                    
                    <button id="BtnAdmin" class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                        👤
                    </button>
                </div>
                <div id="AdminDropDown" class="hidden z-50 absolute right-0 mt-2 bg-white shadow-lg rounded-lg p-2 min-w-[160px]">
                    <h1 class="bg-gray-300 px-4 py-2 rounded-lg mb-2">
                        {{ Auth::user()->name }}
                    </h1>
                    <a href="{{ route('profile.show') }}">Profile</a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center text-red-500 hover:text-red-700 w-full px-4 py-2 rounded hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            <span class="ml-2">Logout</span>
                        </button>
                    </form>
                </div>
                  <!-- Dropdown for Notifications -->
    <div id="notificationDropdown" class="hidden absolute right-0 mt-2 bg-white shadow-lg rounded-lg p-2 min-w-[250px]">
        <h1 class="text-sm font-bold px-4 py-2">Notifications</h1>
        @foreach(auth()->user()->unreadNotifications as $notification)
            <div class="px-4 py-2 text-sm border-b">
                {{ $notification->data['message'] }}
            </div>
        @endforeach
        <button id="markAsRead" class="w-full text-blue-500 text-sm py-2">Mark all as read</button>
    </div>

            </div>
            
        
            @include('components.admin.user-dropdown')

        </header>
    <div class="flex-1 transition-all duration-300">

       
            
           
       

       