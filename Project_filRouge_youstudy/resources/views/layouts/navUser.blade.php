<div class="w-72 bg-white shadow-lg md:block hidden h-screen fixed">
    <!-- Profile Section -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center space-x-4">
            <div class="relative">
                <img src="https://ui-avatars.com/api/?name=Sarah+Miller&background=FF7D29&color=fff" alt="Profile"
                    class="w-14 h-14 rounded-full ring-2 ring-orange-primary p-[2px]">
                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border-2 border-white"></div>
            </div>
            <div>
                <h2 class="text-lg font-bold text-orange-primary">Bonjour {{ Auth::user()->name }}</h2>
                <p class="text-sm text-gray-500">
                    @if (Auth::user()->user_premium)
                        <span class="text-green-500">Premium</span>
                    @else
                        <span class="text-red-500">Utilsateur</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation avec scroll si nécessaire -->
    <nav class="p-4 space-y-2 h-[calc(100vh-116px)] overflow-y-auto">
        <a href="{{ route('dashboardUser') }}"
            class="sidebar-link flex items-center px-4 py-3 rounded-xl @if (request()->is('dashboardUser')) bg-orange-primary text-white @else text-gray-700 @endif">
            <i class="fas fa-th-large w-5"></i>
            <span class="ml-3">Dashboard</span>
        </a>

        <a href="{{ route('myCourses') }}"
            class="sidebar-link flex items-center px-4 py-3 rounded-xl @if (request()->is('myCourses')) bg-orange-primary text-white @else text-gray-700 @endif">
            <i class="fas fa-book w-5"></i>
            <span class="ml-3">My Courses</span>
        </a>

        <a href="#" class="sidebar-link flex items-center px-4 py-3 rounded-xl text-gray-700">
            <i class="fas fa-calendar w-5"></i>
            <span class="ml-3">Schedule</span>
        </a>

        <a href="#" class="sidebar-link flex items-center px-4 py-3 rounded-xl text-gray-700">
            <i class="fas fa-chart-line w-5"></i>
            <span class="ml-3">Progress</span>
        </a>

        <a href="#" class="sidebar-link flex items-center px-4 py-3 rounded-xl text-gray-700">
            <i class="fas fa-robot w-5"></i>
            <span class="ml-3">AI Assistant</span>
        </a>

        <!-- Logout en bas fixe -->
        <div class="absolute bottom-0 left-0 w-full p-4 bg-white border-t">
            <a href={{ Route('logout') }}
                class="sidebar-link flex items-center  px-4 py-3 rounded-xl text-gray-700  hover:bg-red-500 hover:text-white transition duration-300">
                <i class="fas fa-sign-out-alt w-5"></i>
                <span class="ml-3">Logout</span>
            </a>
        </div>
    </nav>
</div>

<!-- Ajout d'un div pour le décalage du contenu -->
<div class="w-72 hidden md:block"></div>

<!-- Mobile Navigation -->
<div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t z-50">
    <div class="flex justify-around p-4">
        <a href="{{ route('dashboardUser') }}"
            @if (request()->is('dashboardUser')) class="text-orange-primary" @else class="text-gray-700" @endif>
            <i class="fas fa-th-large"></i>
        </a>
        <a href="{{ route('myCourses') }}"
            @if (request()->is('myCourses')) class="text-orange-primary" @else class="text-gray-700" @endif>
            <i class="fas fa-book"></i>
        </a>
        <a href="#"
            @if (request()->is('schedule')) class="text-orange-primary" @else class="text-gray-700" @endif>
            <i class="fas fa-calendar"></i>
        </a>
        <a href="#"
            @if (request()->is('progress')) class="text-orange-primary" @else class="text-gray-700" @endif>
            <i class="fas fa-robot"></i>
        </a>
    </div>
</div>
