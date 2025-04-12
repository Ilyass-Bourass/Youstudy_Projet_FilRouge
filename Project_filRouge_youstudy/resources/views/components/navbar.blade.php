<nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-center h-14 sm:h-16">
            <div class="flex-shrink-0">
                <img class="h-8 sm:h-12" src="{{ asset('images/logo.svg') }}" alt="Logo">
            </div>
            @if(Auth::check())
                <div class="hidden md:flex items-center space-x-4">
                    
                    <a href="{{ Auth::user()->role == 'admin' ? route('dashboardAdmin') : route('dashboardUser') }}" class="text-sm sm:text-base bg-[#FF7D29] text-white px-3 sm:px-6 py-2 rounded-lg hover:bg-opacity-90">Dashboard</a>
                    <a href="{{ route('logout') }}" class="text-sm sm:text-base bg-[#FF0000] text-white px-3 sm:px-6 py-2 rounded-lg hover:bg-opacity-90">Déconnexion</a>
                </div>
            @else
            <div class="flex space-x-2 sm:space-x-4">
                <a href="{{ route('showRegister') }}" class="text-sm sm:text-base bg-[#FF7D29] text-white px-3 sm:px-6 py-2 rounded-lg hover:bg-opacity-90">S'inscrire</a>
                <a href="{{ route('showLogin') }}" class="text-sm sm:text-base border-2 border-[#FF7D29] text-[#FF7D29] px-3 sm:px-6 py-2 rounded-lg hover:bg-[#FF7D29] hover:text-white">Connexion</a>
            </div>
            @endif
        </div>
    </div>
</nav>