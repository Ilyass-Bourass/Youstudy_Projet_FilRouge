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

            <!-- Users Sections -->
            <div class="space-y-8">
                <!-- Regular Users Section -->
                <div class="glass-effect rounded-2xl p-6">
                    <h2 class="text-xl font-bold text-primary mb-6">Utilisateurs Standards</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left border-b border-primary border-opacity-20">
                                    <th class="pb-4 text-gray-600">Utilisateur</th>
                                    <th class="pb-4 text-gray-600">Email</th>
                                    <th class="pb-4 text-gray-600">Date d'inscription</th>
                                    <th class="pb-4 text-gray-600">Statut</th>
                                    <th class="pb-4 text-gray-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-primary divide-opacity-20">
                                @foreach ($users as $user)
                                <tr class="hover:bg-white hover:bg-opacity-50 transition-colors">
                                    <td class="py-4">
                                        <div class="flex items-center space-x-3">
                                            <img src="https://ui-avatars.com/api/?name={{ $user->name }}" class="w-10 h-10 rounded-xl">
                                            <span class="font-medium">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4">{{ $user->email }}</td>
                                    <td class="py-4">{{ $user->created_at }}</td>
                                    <td class="py-4">
                                        <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm">
                                            Actif
                                        </span>
                                    </td>
                                    <td class="py-4">
                                        <div class="flex space-x-2">
                                            <button class="p-2 text-secondary hover:bg-secondary hover:bg-opacity-10 rounded-lg transition-colors"
                                                    title="Activer Premium">
                                                <i class="fas fa-crown"></i>
                                            </button>
                                            <button class="p-2 text-red-500 hover:bg-red-100 rounded-lg transition-colors"
                                                    title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Premium Users Section -->
                <div class="glass-effect rounded-2xl p-6">
                    <h2 class="text-xl font-bold text-secondary mb-6">Utilisateurs Premium</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left border-b border-secondary border-opacity-20">
                                    <th class="pb-4 text-gray-600">Utilisateur</th>
                                    <th class="pb-4 text-gray-600">Email</th>
                                    <th class="pb-4 text-gray-600">Date Premium</th>
                                    <th class="pb-4 text-gray-600">Statut</th>
                                    <th class="pb-4 text-gray-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-secondary divide-opacity-20">
                                @foreach ($usersPremium as $user)
                                <tr class="hover:bg-white hover:bg-opacity-50 transition-colors">
                                    <td class="py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="relative">
                                                <img src="https://ui-avatars.com/api/?name={{$user->name}}" class="w-10 h-10 rounded-xl">
                                                <i class="fas fa-crown text-secondary absolute -top-1 -right-1 text-sm"></i>
                                            </div>
                                            <span class="font-medium">{{$user->name}}</span>
                                        </div>
                                    </td>
                                    <td class="py-4">{{$user->email}}</td>
                                    <td class="py-4">{{$user->created_at}}</td>
                                    <td class="py-4">
                                        <span class="px-3 py-1 bg-secondary bg-opacity-10 text-secondary rounded-full text-sm">
                                            Premium
                                        </span>
                                    </td>
                                    <td class="py-4">
                                        <div class="flex space-x-2">
                                            <button class="p-2 text-secondary hover:bg-secondary hover:bg-opacity-10 rounded-lg transition-colors"
                                                    title="Désactiver Premium">
                                                <i class="fas fa-minus-circle"></i>
                                            </button>
                                            <button class="p-2 text-red-500 hover:bg-red-100 rounded-lg transition-colors"
                                                    title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
