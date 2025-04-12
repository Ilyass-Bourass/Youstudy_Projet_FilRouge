<!-- Bouton Toggle Sidebar (visible sur mobile) -->
<button id="sidebarToggle" class="fixed lg:hidden z-50 bottom-6 right-6 p-4 rounded-full bg-gradient-to-r from-primary to-secondary text-white shadow-lg">
    <i class="fas fa-bars"></i>
</button>

<!-- Overlay pour mobile -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black opacity-50 lg:hidden hidden z-30"></div>

<!-- Sidebar -->
<div id="sidebar" class="fixed inset-y-0 left-0 w-64 glass-effect shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-40">
    <!-- Logo Section -->
    <div class="flex items-center justify-between h-20 bg-gradient-to-r from-primary to-secondary px-4">
        <div class="flex items-center space-x-2">
            <i class="fas fa-graduation-cap text-3xl text-white"></i>
            <span class="text-2xl font-bold text-white">You<span class="text-yellow-light">Study</span></span>
        </div>
        <!-- Bouton fermeture sur mobile -->
        <button id="closeSidebar" class="lg:hidden text-white">
            <i class="fas fa-times"></i>
        </button>
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
        <a href="{{ route('chapitres') }}" 
           class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-primary hover:bg-opacity-20 hover:text-secondary transition-all group">
            <div class="w-10 h-10 rounded-lg bg-primary bg-opacity-10 flex items-center justify-center group-hover:bg-secondary group-hover:bg-opacity-10">
                <i class="fas fa-book text-lg text-primary group-hover:text-secondary"></i>
            </div>
            <span class="ml-3 font-medium">Chapitres</span>
        </a>

        <!-- Cours -->
        <a href="{{ route('cours') }}" 
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
            <a href="{{ route('users') }}" 
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
                <a href={{Route('logout')}} class="text-xs text-secondary hover:text-primary transition-colors">
                    Se déconnecter
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Script pour la gestion du sidebar responsive -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const closeSidebar = document.getElementById('closeSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const mainContent = document.querySelector('.ml-64');

        // Fonction pour ouvrir le sidebar
        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Fonction pour fermer le sidebar
        function closeSidebarMenu() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Event listeners
        sidebarToggle.addEventListener('click', openSidebar);
        closeSidebar.addEventListener('click', closeSidebarMenu);
        overlay.addEventListener('click', closeSidebarMenu);

        // Gestion du responsive pour le contenu principal
        function updateMainContentMargin() {
            if (window.innerWidth >= 1024) { // lg breakpoint
                mainContent.classList.add('ml-64');
            } else {
                mainContent.classList.remove('ml-64');
            }
        }

        // Initial check
        updateMainContentMargin();

        // Listen for window resize
        window.addEventListener('resize', updateMainContentMargin);
    });
</script> 