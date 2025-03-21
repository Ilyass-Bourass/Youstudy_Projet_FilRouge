<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Plateforme d'apprentissage</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FEFFD2]">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6">
        <!-- Conteneur principal avec barre de progression -->
        <div class="max-w-md w-full space-y-8 bg-white p-6 sm:p-8 rounded-xl shadow-lg">
            <!-- Barre de progression -->
            <div class="space-y-4">
                <h2 class="text-center text-2xl sm:text-3xl font-bold text-gray-800">Créer un compte</h2>
                <div class="flex items-center justify-between px-4">
                    <div class="w-full flex items-center">
                        <div class="relative flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-[#FF7D29] flex items-center justify-center text-white font-bold" id="step1-indicator">1</div>
                            <span class="text-xs mt-1">Profil</span>
                        </div>
                        <div class="flex-1 h-1 mx-2 bg-[#FFBF78]" id="line1"></div>
                        <div class="relative flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-white font-bold" id="step2-indicator">2</div>
                            <span class="text-xs mt-1">Vérification</span>
                        </div>
                        <div class="flex-1 h-1 mx-2 bg-gray-300" id="line2"></div>
                        <div class="relative flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-white font-bold" id="step3-indicator">3</div>
                            <span class="text-xs mt-1">Finalisation</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Étape 1: Informations de base -->
            <div id="step1" class="mt-8 space-y-6">
                <div class="space-y-4">
                    {{-- <div>
                        <label class="block text-sm font-medium text-gray-700">Type de compte</label>
                        <select id="accountType" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF7D29] focus:border-[#FF7D29]">
                            <option value="">Sélectionnez votre profil</option>
                            <option value="etudiant">Étudiant</option>
                            <option value="enseignant">Enseignant</option>
                        </select>
                    </div> --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nom complet</label>
                        <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF7D29] focus:border-[#FF7D29]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF7D29] focus:border-[#FF7D29]">
                    </div>
                </div>
                <button onclick="nextStep(2)" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF7D29] hover:bg-opacity-90">
                    Continuer
                </button>
            </div>

            <!-- Étape 2: Vérification -->
            <div id="step2" class="mt-8 space-y-6 hidden">
                <div class="space-y-4">
                    <p class="text-center text-sm text-gray-600">Un code de vérification a été envoyé à votre adresse email</p>
                    <div class="flex justify-center space-x-2">
                        <input type="text" maxlength="1" class="w-12 h-12 text-center border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF7D29] focus:border-[#FF7D29]">
                        <input type="text" maxlength="1" class="w-12 h-12 text-center border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF7D29] focus:border-[#FF7D29]">
                        <input type="text" maxlength="1" class="w-12 h-12 text-center border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF7D29] focus:border-[#FF7D29]">
                        <input type="text" maxlength="1" class="w-12 h-12 text-center border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF7D29] focus:border-[#FF7D29]">
                        <input type="text" maxlength="1" class="w-12 h-12 text-center border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF7D29] focus:border-[#FF7D29]">
                        <input type="text" maxlength="1" class="w-12 h-12 text-center border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF7D29] focus:border-[#FF7D29]">
                    </div>
                </div>
                <div class="flex space-x-4">
                    <button onclick="prevStep(1)" class="w-1/2 py-2 px-4 border border-[#FF7D29] rounded-md shadow-sm text-sm font-medium text-[#FF7D29] bg-white hover:bg-gray-50">
                        Retour
                    </button>
                    <button onclick="nextStep(3)" class="w-1/2 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF7D29] hover:bg-opacity-90">
                        Vérifier
                    </button>
                </div>
            </div>

            <!-- Étape 3: Finalisation -->
            <div id="step3" class="mt-8 space-y-6 hidden">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        <input type="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF7D29] focus:border-[#FF7D29]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                        <input type="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF7D29] focus:border-[#FF7D29]">
                    </div>
                </div>
                <div class="flex space-x-4">
                    <button onclick="prevStep(2)" class="w-1/2 py-2 px-4 border border-[#FF7D29] rounded-md shadow-sm text-sm font-medium text-[#FF7D29] bg-white hover:bg-gray-50">
                        Retour
                    </button>
                    <button onclick="finishRegistration()" class="w-1/2 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF7D29] hover:bg-opacity-90">
                        Terminer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function nextStep(step) {
            // Cacher l'étape actuelle
            document.getElementById('step' + (step-1)).classList.add('hidden');
            // Afficher la nouvelle étape
            document.getElementById('step' + step).classList.remove('hidden');
            
            // Mettre à jour les indicateurs
            document.getElementById('step' + step + '-indicator').classList.remove('bg-gray-300');
            document.getElementById('step' + step + '-indicator').classList.add('bg-[#FF7D29]');
            
            // Mettre à jour les lignes de progression
            if(step > 1) {
                document.getElementById('line' + (step-1)).classList.remove('bg-gray-300');
                document.getElementById('line' + (step-1)).classList.add('bg-[#FF7D29]');
            }
        }

        function prevStep(step) {
            // Cacher l'étape actuelle
            document.getElementById('step' + (step+1)).classList.add('hidden');
            // Afficher l'étape précédente
            document.getElementById('step' + step).classList.remove('hidden');
            
            // Mettre à jour les indicateurs
            document.getElementById('step' + (step+1) + '-indicator').classList.remove('bg-[#FF7D29]');
            document.getElementById('step' + (step+1) + '-indicator').classList.add('bg-gray-300');
            
            // Mettre à jour les lignes de progression
            document.getElementById('line' + step).classList.remove('bg-[#FF7D29]');
            document.getElementById('line' + step).classList.add('bg-gray-300');
        }

        function finishRegistration() {
            
            window.location.href = '{{ route('showLogin')}}';
        }
    </script>
</body>
</html> 