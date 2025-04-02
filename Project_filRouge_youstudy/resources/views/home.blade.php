<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme d'apprentissage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --orange-primary: #FF7D29;
            --orange-light: #FFBF78;
            --yellow-light: #FFEEA9;
            --cream: #FEFFD2;
            --white: #FFFFFF;
        }
    </style>
</head>
<body class="bg-white">
    <!-- Navbar -->
   
    <x-navbar />
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-[#FEFFD2] to-[#FFEEA9] py-10 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 items-center">
                <div class="text-center md:text-left">
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 mb-4 sm:mb-6">Apprenez à votre rythme</h1>
                    <p class="text-base sm:text-lg text-gray-600 mb-6 sm:mb-8 px-4 sm:px-0">Découvrez une nouvelle façon d'apprendre avec notre plateforme interactive. Accédez à des cours de qualité, des quiz et suivez votre progression.</p>
                    <a href="{{ route('showRegister') }}" class="bg-[#FF7D29] text-white px-6 sm:px-8 py-2 sm:py-3 rounded-lg hover:bg-opacity-90 inline-block">Commencer</a>
                </div>
                <div class="flex justify-center mt-6 md:mt-0">
                    <img src="{{ asset('images/section01Home.jpg') }}" alt="Étudiant" class="w-full max-w-[250px] sm:max-w-md">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-10 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                 <!-- Cours -->
                 <div class="bg-[#FFBF78] rounded-xl p-4 sm:p-6 text-center hover:shadow-lg transition">
                    <div class="text-3xl sm:text-4xl mb-3">📚</div>
                    <h3 class="text-lg sm:text-xl font-semibold mb-2">Cours Détaillés</h3>
                    <p class="text-sm sm:text-base text-gray-700">Accédez à des cours complets et structurés</p>
                </div>
                
                <!-- Exercices -->
                <div class="bg-[#FFEEA9] rounded-xl p-4 sm:p-6 text-center hover:shadow-lg transition">
                    <div class="text-3xl sm:text-4xl mb-3">✏️</div>
                    <h3 class="text-lg sm:text-xl font-semibold mb-2">Exercices Pratiques</h3>
                    <p class="text-sm sm:text-base text-gray-700">Pratiquez avec des exercices variés et corrigés</p>
                </div>

                <!-- Quiz -->
                <div class="bg-[#FEFFD2] rounded-xl p-4 sm:p-6 text-center hover:shadow-lg transition">
                    <div class="text-3xl sm:text-4xl mb-3">📝</div>
                    <h3 class="text-lg sm:text-xl font-semibold mb-2">Quiz Interactifs</h3>
                    <p class="text-sm sm:text-base text-gray-700">Testez vos connaissances avec nos quiz adaptés à votre niveau</p>
                </div>
                
                <!-- Progression -->
                <div class="bg-[#FFFFFF] shadow-md rounded-xl p-4 sm:p-6 text-center hover:shadow-lg transition">
                    <div class="text-3xl sm:text-4xl mb-3">📊</div>
                    <h3 class="text-lg sm:text-xl font-semibold mb-2">Suivi de Progression</h3>
                    <p class="text-sm sm:text-base text-gray-700">Visualisez votre évolution et vos résultats</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Matières -->
    <section class="py-12 bg-gradient-to-r from-[#FEFFD2] to-[#FFEEA9]">
        <h2 class="text-3xl font-bold text-center mb-12">Matières Disponibles</h2>
        <div class="max-w-5xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Mathématiques -->
            <div class="bg-white rounded-xl p-6 hover:shadow-xl transition-shadow duration-300 text-center">
                <div class="bg-[#FFBF78] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-3xl">📐</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Mathématiques</h3>
                <p class="text-sm text-gray-600">Algèbre, Géométrie, Analyse</p>
            </div>

            <!-- Physique-Chimie -->
            <div class="bg-white rounded-xl p-6 hover:shadow-xl transition-shadow duration-300 text-center">
                <div class="bg-[#FFBF78] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-3xl">⚗️</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Physique-Chimie</h3>
                <p class="text-sm text-gray-600">Physique, Chimie</p>
            </div>

            <!-- SVT -->
            <div class="bg-white rounded-xl p-6 hover:shadow-xl transition-shadow duration-300 text-center">
                <div class="bg-[#FFBF78] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-3xl">🧬</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Sciences de la Vie et de la Terre</h3>
                <p class="text-sm text-gray-600">SVT</p>
            </div>
        </div>
    </section>

    <!-- Section Témoignages -->
    <section class="py-12 bg-[#FEFFD2]">
        <h2 class="text-3xl font-bold text-center mb-12">Témoignages d'Étudiants</h2>
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Témoignage 1 -->
            <div class="bg-white rounded-xl p-6 shadow-md">
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 bg-[#FFBF78] rounded-full overflow-hidden mb-4 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Fatima Zahra</h3>
                    <p class="text-sm text-gray-600 mb-4">Lycée Mohammed VI - Marrakech</p>
                    <p class="text-sm text-gray-700 italic text-center">"Cette plateforme m'a beaucoup aidée à améliorer mes notes en mathématiques et en physique."</p>
                </div>
            </div>

            <!-- Témoignage 2 -->
            <div class="bg-white rounded-xl p-6 shadow-md">
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 bg-[#FFBF78] rounded-full overflow-hidden mb-4 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Youssef El Amrani</h3>
                    <p class="text-sm text-gray-600 mb-4">Lycée Moulay Youssef - Rabat</p>
                    <p class="text-sm text-gray-700 italic text-center">"Les vidéos explicatives sont très claires et m'aident à mieux comprendre les leçons."</p>
                </div>
            </div>

            <!-- Témoignage 3 -->
            <div class="bg-white rounded-xl p-6 shadow-md">
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 bg-[#FFBF78] rounded-full overflow-hidden mb-4 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Nada Benjelloun</h3>
                    <p class="text-sm text-gray-600 mb-4">Lycée Hassan II - Casablanca</p>
                    <p class="text-sm text-gray-700 italic text-center">"Un excellent support pour la préparation du baccalauréat. Je le recommande vivement!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
   <x-footer />
</body>
</html> 