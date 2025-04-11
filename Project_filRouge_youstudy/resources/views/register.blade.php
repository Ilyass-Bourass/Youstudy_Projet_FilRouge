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

            <!-- Affichage des erreurs de validation -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulaire d'inscription -->
            <form action="{{ route('register') }}" method="POST" class="mt-8 space-y-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF7D29] focus:border-[#FF7D29]" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF7D29] focus:border-[#FF7D29]" required>
                    </div>
                </div>
                <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF7D29] hover:bg-opacity-90">
                    Continuer
                </button>
            </form>
        </div>
    </div>
</body>
</html>