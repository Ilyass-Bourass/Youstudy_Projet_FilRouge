<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalisation - Plateforme d'apprentissage</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FEFFD2]">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6">
        <!-- Conteneur principal avec barre de progression -->
        <div class="max-w-md w-full space-y-8 bg-white p-6 sm:p-8 rounded-xl shadow-lg">
            <!-- Barre de progression -->
            <div class="space-y-4">
                <h2 class="text-center text-2xl sm:text-3xl font-bold text-gray-800">Finalisation</h2>
                <div class="flex items-center justify-between px-4">
                    <div class="w-full flex items-center">
                        <div class="relative flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-[#FF7D29] flex items-center justify-center text-white font-bold">1</div>
                            <span class="text-xs mt-1">Profil</span>
                        </div>
                        <div class="flex-1 h-1 mx-2 bg-[#FF7D29]"></div>
                        <div class="relative flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-[#FF7D29] flex items-center justify-center text-white font-bold">2</div>
                            <span class="text-xs mt-1">Vérification</span>
                        </div>
                        <div class="flex-1 h-1 mx-2 bg-[#FF7D29]"></div>
                        <div class="relative flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-[#FF7D29] flex items-center justify-center text-white font-bold">3</div>
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

            <!-- Formulaire de finalisation -->
            <form action="{{ route('complete.registration') }}" method="POST" class="mt-8 space-y-6">
                @csrf
                <div class="space-y-4">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF7D29] focus:border-[#FF7D29]" required>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF7D29] focus:border-[#FF7D29]" required>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('verification.notice', ['email' => $email]) }}" class="w-1/2 py-2 px-4 border border-[#FF7D29] rounded-md shadow-sm text-sm font-medium text-[#FF7D29] bg-white hover:bg-gray-50 text-center">
                        Retour
                    </a>
                    <button type="submit" class="w-1/2 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF7D29] hover:bg-opacity-90">
                        Terminer
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>