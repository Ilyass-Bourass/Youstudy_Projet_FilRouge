<div class="fixed inset-y-0 left-0 w-64 glass-effect shadow-lg">
    <!-- Logo Section -->
    <div class="flex items-center justify-center h-20 bg-gradient-to-r from-primary to-secondary">
        <div class="flex items-center space-x-2">
            <i class="fas fa-graduation-cap text-3xl text-white"></i>
            <span class="text-2xl font-bold text-white">You<span class="text-yellow-light">Study</span></span>
        </div>
    </div>

    <!-- Navigation Links -->
    <nav class="px-4 py-6 space-y-3">
        <!-- Dashboard -->
        <a href="{{ route('dashboardAdmin') }}" 
           class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-primary hover:bg-opacity-20 hover:text-secondary transition-all group">
            <div class="w-10 h-10 rounded-lg bg-primary bg-opacity-10 flex items-center justify-center group-hover:bg-secondary group-hover:bg-opacity-10">
                <i class="fas fa-home text-lg text-primary group-hover:text-secondary"></i>
            </div>
            <span class="ml-3 font-medium">Dashboard</span>
        </a>

        <!-- Chapitres -->
        <a href="#" 
           class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-primary hover:bg-opacity-20 hover:text-secondary transition-all group">
            <div class="w-10 h-10 rounded-lg bg-primary bg-opacity-10 flex items-center justify-center group-hover:bg-secondary group-hover:bg-opacity-10">
                <i class="fas fa-book text-lg text-primary group-hover:text-secondary"></i>
            </div>
            <span class="ml-3 font-medium">Chapitres</span>
        </a>

        <!-- Cours -->
        <a href="#" 
           class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-primary hover:bg-opacity-20 hover:text-secondary transition-all group">
            <div class="w-10 h-10 rounded-lg bg-primary bg-opacity-10 flex items-center justify-center group-hover:bg-secondary group-hover:bg-opacity-10">
                <i class="fas fa-video text-lg text-primary group-hover:text-secondary"></i>
            </div>
            <span class="ml-3 font-medium">Cours</span>
        </a>

        <!-- Quiz -->
        <a href="#" 
           class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-primary hover:bg-opacity-20 hover:text-secondary transition-all group">
            <div class="w-10 h-10 rounded-lg bg-primary bg-opacity-10 flex items-center justify-center group-hover:bg-secondary group-hover:bg-opacity-10">
                <i class="fas fa-question-circle text-lg text-primary group-hover:text-secondary"></i>
            </div>
            <span class="ml-3 font-medium">Quiz</span>
        </a>

        <!-- Exercices -->
        <a href="#" 
           class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-primary hover:bg-opacity-20 hover:text-secondary transition-all group">
            <div class="w-10 h-10 rounded-lg bg-primary bg-opacity-10 flex items-center justify-center group-hover:bg-secondary group-hover:bg-opacity-10">
                <i class="fas fa-pencil-alt text-lg text-primary group-hover:text-secondary"></i>
            </div>
            <span class="ml-3 font-medium">Exercices</span>
        </a>

        <!-- Utilisateurs -->
        <div class="space-y-3 mt-6">
            <a href="#" 
               class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-primary hover:bg-opacity-20 hover:text-secondary transition-all group">
                <div class="w-10 h-10 rounded-lg bg-primary bg-opacity-10 flex items-center justify-center group-hover:bg-secondary group-hover:bg-opacity-10">
                    <i class="fas fa-users text-lg text-primary group-hover:text-secondary"></i>
                </div>
                <span class="ml-3 font-medium">Utilisateurs</span>
            </a>
            
            <!-- Demandes Premium -->
            <a href="#" 
               class="flex items-center px-4 py-3 ml-4 text-gray-700 rounded-xl hover:bg-primary hover:bg-opacity-20 hover:text-secondary transition-all group">
                <div class="w-10 h-10 rounded-lg bg-secondary bg-opacity-10 flex items-center justify-center group-hover:bg-primary group-hover:bg-opacity-10">
                    <i class="fas fa-crown text-lg text-secondary group-hover:text-primary"></i>
                </div>
                <span class="ml-3 font-medium">Demandes Premium</span>
                <span class="ml-auto bg-secondary text-white px-2 py-1 text-xs rounded-full">
                    3
                </span>
            </a>
        </div>
    </nav>

    <!-- Admin Profile -->
    <div class="absolute bottom-0 left-0 right-0 p-4">
        <div class="flex items-center space-x-3 p-4 rounded-xl glass-effect border border-primary border-opacity-20">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-primary to-secondary flex items-center justify-center text-white text-xl font-bold">
                A
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">Admin</p>
                <a href="#" class="text-xs text-secondary hover:text-primary transition-colors">
                    Se déconnecter
                </a>
            </div>
        </div>
    </div>
</div> 