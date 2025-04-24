<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs - YouStudy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #B7793E;
            --secondary: #D96C06;
            --yellow-light: #FFEEA9;
            --cream: #FEFFD2;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(183, 121, 62, 0.2);
        }

        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(183, 121, 62, 0.1), 0 2px 4px -1px rgba(183, 121, 62, 0.06);
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#B7793E',
                        'secondary': '#D96C06',
                        'yellow-light': '#FFEEA9',
                        'cream': '#FEFFD2',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-br from-cream to-yellow-light min-h-screen">
    <div class="flex">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 ml-64 p-8">
            <!-- Header Section -->
            <div class="glass-effect rounded-2xl p-6 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-secondary mb-2">
                            Gestion des <span class="text-primary">Utilisateurs</span>
                        </h1>
                        <p class="text-gray-600">Gérez les utilisateurs de la plateforme</p>
                    </div>
                </div>
            </div>

            <!-- Messages flash -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Users Sections -->
            <div class="space-y-8">
                <!-- Regular Users Section -->
                <div class="glass-effect rounded-2xl p-6">
                    <h2 class="text-xl font-bold text-primary mb-6 flex items-center">
                        <i class="fas fa-users mr-2"></i> Utilisateurs Standards
                    </h2>

                    <!-- Table des utilisateurs standards - Version modernisée -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full rounded-xl overflow-hidden">
                            <thead>
                                <tr class="bg-gradient-to-r from-primary/20 to-secondary/20 text-left">
                                    <th class="px-6 py-4 text-sm font-semibold text-gray-700">Utilisateur</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-gray-700">Email</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-gray-700">Date d'inscription</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-gray-700">Statut</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr
                                        class="border-b border-primary/10 hover:bg-gradient-to-r hover:from-yellow-50 hover:to-cream transition-all duration-200">
                                        <td class="px-6 py-3">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-md overflow-hidden">
                                                    <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random&color=fff"
                                                        class="w-full h-full object-cover">
                                                </div>
                                                <p class="font-medium">{{ $user->name }}</p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-gray-700">{{ $user->email }}</td>
                                        <td class="px-6 py-3 text-gray-600 text-sm">
                                            {{ $user->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-6 py-3">
                                            <div
                                                class="inline-flex items-center px-2.5 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">
                                                <div class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5 animate-pulse">
                                                </div>
                                                Actif
                                            </div>
                                        </td>
                                        <td class="px-6 py-3">
                                            <div class="flex items-center space-x-3">
                                                <form action="{{ route('activerPremium', $user->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="group relative rounded-full p-2 bg-amber-50 hover:bg-amber-100 transition-colors"
                                                        title="Activer Premium">
                                                        <i class="fas fa-crown text-amber-600"></i>
                                                        <span
                                                            class="absolute -top-8 left-1/2 -translate-x-1/2 w-max py-1 px-2 bg-gray-800 text-xs text-white rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300">Activer
                                                            Premium</span>
                                                    </button>
                                                </form>

                                                <form action="{{ route('deleteUser', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="group relative rounded-full p-2 bg-red-50 hover:bg-red-100 transition-colors"
                                                        title="Supprimer">
                                                        <i class="fas fa-trash text-red-600"></i>
                                                        <span
                                                            class="absolute -top-8 left-1/2 -translate-x-1/2 w-max py-1 px-2 bg-gray-800 text-xs text-white rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300">Supprimer</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div
                                                    class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                                                    <i class="fas fa-user-slash text-gray-400 text-2xl"></i>
                                                </div>
                                                <p class="text-gray-500 font-medium">Aucun utilisateur trouvé</p>
                                                <p class="text-gray-400 text-sm mt-1">Les utilisateurs standards seront
                                                    affichés ici</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Premium Users Section -->
                <div class="glass-effect rounded-2xl p-6">
                    <h2 class="text-xl font-bold text-secondary mb-6 flex items-center">
                        <i class="fas fa-crown mr-2"></i> Utilisateurs Premium
                    </h2>

                    <!-- Table des utilisateurs premium - Version modernisée -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full rounded-xl overflow-hidden">
                            <thead>
                                <tr class="bg-gradient-to-r from-amber-200 to-amber-300/50 text-left">
                                    <th class="px-6 py-4 text-sm font-semibold text-gray-700">Utilisateur</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-gray-700">Email</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-gray-700">Date Premium</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-gray-700">Statut</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($usersPremium as $user)
                                    <tr
                                        class="border-b border-amber-200/30 hover:bg-gradient-to-r hover:from-yellow-50 hover:to-amber-50 transition-all duration-200">
                                        <td class="px-6 py-3">
                                            <div class="flex items-center gap-3">
                                                <div class="relative">
                                                    <div
                                                        class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center shadow-md overflow-hidden">
                                                        <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random&color=fff"
                                                            class="w-full h-full object-cover">
                                                    </div>
                                                    <div
                                                        class="absolute -top-1 -right-1 bg-gradient-to-br from-amber-400 to-amber-600 rounded-full p-0.5 shadow-md">
                                                        <i class="fas fa-crown text-white text-xs"></i>
                                                    </div>
                                                </div>
                                                <p class="font-medium">{{ $user->name }}</p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-gray-700">{{ $user->email }}</td>
                                        <td class="px-6 py-3 text-gray-600 text-sm">
                                            {{ $user->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-6 py-3">
                                            <div
                                                class="inline-flex items-center px-2.5 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-medium">
                                                <i class="fas fa-crown text-amber-500 mr-1.5"></i>
                                                Premium
                                            </div>
                                        </td>
                                        <td class="px-6 py-3">
                                            <div class="flex items-center space-x-3">
                                                <form action="{{ route('desactiverPremium', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="group relative rounded-full p-2 bg-gray-50 hover:bg-gray-100 transition-colors"
                                                        title="Désactiver Premium">
                                                        <i class="fas fa-minus-circle text-gray-600"></i>
                                                        <span
                                                            class="absolute -top-8 left-1/2 -translate-x-1/2 w-max py-1 px-2 bg-gray-800 text-xs text-white rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300">Désactiver
                                                            Premium</span>
                                                    </button>
                                                </form>

                                                <form action="{{ route('deleteUser', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="group relative rounded-full p-2 bg-red-50 hover:bg-red-100 transition-colors"
                                                        title="Supprimer">
                                                        <i class="fas fa-trash text-red-600"></i>
                                                        <span
                                                            class="absolute -top-8 left-1/2 -translate-x-1/2 w-max py-1 px-2 bg-gray-800 text-xs text-white rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300">Supprimer</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div
                                                    class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                                                    <i class="fas fa-crown text-gray-400 text-2xl"></i>
                                                </div>
                                                <p class="text-gray-500 font-medium">Aucun utilisateur premium</p>
                                                <p class="text-gray-400 text-sm mt-1">Les utilisateurs premium seront
                                                    affichés ici</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
