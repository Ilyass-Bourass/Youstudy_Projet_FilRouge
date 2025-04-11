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
        <div class="flex-1 p-8 lg:ml-64">
            <!-- Header Section -->
            <div class="glass-effect rounded-2xl p-6 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-secondary mb-2">
                            Gestion des <span class="text-primary">Chapitres</span>
                        </h1>
                        <p class="text-gray-600">Gérez le contenu des chapitres et leurs cours vidéo</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-xl hover:opacity-90 transition-all shadow-lg">
                            <i class="fas fa-plus mr-2"></i>Nouveau Chapitre
                        </button>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Chapitres -->
                <div class="glass-effect p-6 rounded-2xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600">Total Chapitres</p>
                            <h3 class="text-3xl font-bold text-primary mt-1">15</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-primary bg-opacity-10 flex items-center justify-center">
                            <i class="fas fa-book text-primary text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Cours Vidéo -->
                <div class="glass-effect p-6 rounded-2xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600">Cours Vidéo</p>
                            <h3 class="text-3xl font-bold text-secondary mt-1">25</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-secondary bg-opacity-10 flex items-center justify-center">
                            <i class="fas fa-video text-secondary text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Chapitres Actifs -->
                <div class="glass-effect p-6 rounded-2xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600">Chapitres Actifs</p>
                            <h3 class="text-3xl font-bold text-green-600 mt-1">12</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chapitres List -->
            <div class="glass-effect rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-secondary">Liste des Chapitres</h2>
                    <div class="flex space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Rechercher un chapitre..." 
                                   class="pl-10 pr-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <select class="px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary">
                            <option>Tous les chapitres</option>
                            <option>Avec cours vidéo</option>
                            <option>Sans cours vidéo</option>
                            <option>Chapitres Actifs</option>
                            <option>Chapitres Inactifs</option>
                        </select>
                    </div>
                </div>

                <!-- Table des chapitres -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b border-primary border-opacity-20">
                                <th class="pb-4 text-gray-600">Titre</th>
                                <th class="pb-4 text-gray-600">Contenu</th>
                                <th class="pb-4 text-gray-600">Cours Vidéo</th>
                                <th class="pb-4 text-gray-600">Status</th>
                                <th class="pb-4 text-gray-600">Dernière MAJ</th>
                                <th class="pb-4 text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-primary divide-opacity-20">
                            <tr class="hover:bg-white hover:bg-opacity-50 transition-colors">
                                <td class="py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-lg bg-primary bg-opacity-10 flex items-center justify-center">
                                            <i class="fas fa-book-open text-primary"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium">Introduction à l'Algèbre</p>
                                            <p class="text-sm text-gray-500">5 exercices • 2 quiz</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">4 parties</td>
                                <td class="py-4">
                                    <span class="px-3 py-1 bg-secondary bg-opacity-10 text-secondary rounded-full text-sm">
                                        3 vidéos
                                    </span>
                                </td>
                                <td class="py-4">
                                    <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm">
                                        Actif
                                    </span>
                                </td>
                                <td class="py-4 text-sm text-gray-500">Il y a 2 jours</td>
                                <td class="py-4">
                                    <div class="flex space-x-2">
                                        <button class="p-2 text-primary hover:bg-primary hover:bg-opacity-10 rounded-lg transition-colors" 
                                                title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="p-2 text-blue-500 hover:bg-blue-100 rounded-lg transition-colors"
                                                title="Gérer les vidéos">
                                            <i class="fas fa-video"></i>
                                        </button>
                                        <button class="p-2 text-red-500 hover:bg-red-100 rounded-lg transition-colors"
                                                title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
