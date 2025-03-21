<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Plateforme d'apprentissage</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FEFFD2]">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6">
        <div class="max-w-md w-full space-y-8 bg-white p-6 sm:p-8 rounded-xl shadow-lg">
            <!-- En-tête -->
            <div class="text-center">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Connexion</h2>
                <p class="mt-2 text-sm text-gray-600">Bienvenue sur votre plateforme d'apprentissage</p>
            </div>

            <!-- Formulaire de connexion -->
            <form action =" {{ route('login') }} " method="POST" class="mt-8 space-y-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF7D29] focus:border-[#FF7D29]" 
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        <input type="password" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF7D29] focus:border-[#FF7D29]" 
                            required>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" 
                            class="h-4 w-4 text-[#FF7D29] focus:ring-[#FF7D29] border-gray-300 rounded">
                        <label class="ml-2 block text-sm text-gray-700">
                            Se souvenir de moi
                        </label>
                    </div>
                    <a href="#" class="text-sm font-medium text-[#FF7D29] hover:text-opacity-90">
                        Mot de passe oublié ?
                    </a>
                </div>

                <div>
                    <button type="submit" 
                        class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF7D29] hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF7D29]">
                        Se connecter
                    </button>
                </div>
            </form>

            <!-- Séparateur -->
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Ou continuer avec</span>
                    </div>
                </div>
            </div>

            <!-- Boutons de connexion sociale -->
            <div class="mt-6 flex justify-center gap-3">
                <button class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                    <img class="h-5 w-5" src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google">
                    <span class="ml-2">Google</span>
                </button>
            </div>

            <!-- Lien d'inscription -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Pas encore de compte ?
                    <a href="{{ route('register')}}" class="font-medium text-[#FF7D29] hover:text-opacity-90">
                        S'inscrire
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html> 