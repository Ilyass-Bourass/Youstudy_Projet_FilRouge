<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - YouStudy</title>
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
                            <span class="text-primary">You</span>Study Dashboard
                        </h1>
                        <p class="text-gray-600">Bienvenue dans votre espace administrateur</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">
                            <i class="fas fa-calendar-alt text-primary"></i>
                            {{ date('d M Y') }}
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Utilisateurs -->
                <div class="glass-effect p-6 rounded-2xl card-shadow hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-600 font-medium">Total Utilisateurs</h3>
                        <div class="w-12 h-12 rounded-full bg-primary bg-opacity-20 flex items-center justify-center">
                            <i class="fas fa-users text-primary text-xl"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-secondary">1,234</p>
                    <div class="mt-2 flex items-center text-sm text-green-500">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>12% ce mois</span>
                    </div>
                </div>

                <!-- Utilisateurs Premium -->
                <div class="glass-effect p-6 rounded-2xl card-shadow hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-600 font-medium">Utilisateurs Premium</h3>
                        <div class="w-12 h-12 rounded-full bg-secondary bg-opacity-20 flex items-center justify-center">
                            <i class="fas fa-crown text-secondary text-xl"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-secondary">256</p>
                    <div class="mt-2 flex items-center text-sm text-primary">
                        <span>20% des utilisateurs</span>
                    </div>
                </div>

                <!-- Nombre de Chapitres -->
                <div class="glass-effect p-6 rounded-2xl card-shadow hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-600 font-medium">Total Chapitres</h3>
                        <div class="w-12 h-12 rounded-full bg-primary bg-opacity-20 flex items-center justify-center">
                            <i class="fas fa-book text-primary text-xl"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-secondary">15</p>
                    <div class="mt-2 flex items-center text-sm text-blue-500">
                        <i class="fas fa-plus mr-1"></i>
                        <span>3 ce mois</span>
                    </div>
                </div>

                <!-- Moyenne des parties par chapitre -->
                <div class="glass-effect p-6 rounded-2xl card-shadow hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-600 font-medium">Moyenne Parties/Chapitre</h3>
                        <div class="w-12 h-12 rounded-full bg-secondary bg-opacity-20 flex items-center justify-center">
                            <i class="fas fa-chart-bar text-secondary text-xl"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-secondary">5.2</p>
                    <div class="mt-2 flex items-center text-sm text-gray-500">
                        <span>Parties par chapitre</span>
                    </div>
                </div>
            </div>

            <!-- Detailed Stats Section -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Utilisateurs Stats -->
                <div class="glass-effect p-6 rounded-2xl card-shadow">
                    <h3 class="text-xl font-bold text-secondary mb-4">Détails Utilisateurs</h3>
                    <div class="space-y-4">
                        <!-- Nouvelles Inscriptions -->
                        <div class="flex items-center justify-between p-3 bg-white bg-opacity-50 rounded-xl">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-user-plus text-green-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Nouvelles Inscriptions</p>
                                    <p class="text-lg font-bold text-primary">+15 ce mois</p>
                                </div>
                            </div>
                            <div class="text-xs text-green-500">
                                <i class="fas fa-arrow-up"></i> 12%
                            </div>
                        </div>

                        <!-- Utilisateurs Actifs -->
                        <div class="flex items-center justify-between p-3 bg-white bg-opacity-50 rounded-xl">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-user-check text-blue-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Utilisateurs Actifs</p>
                                    <p class="text-lg font-bold text-primary">892 cette semaine</p>
                                </div>
                            </div>
                            <div class="text-xs text-blue-500">
                                72% actifs
                            </div>
                        </div>

                        <!-- Premium Conversions -->
                        <div class="flex items-center justify-between p-3 bg-white bg-opacity-50 rounded-xl">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center">
                                    <i class="fas fa-crown text-yellow-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Conversions Premium</p>
                                    <p class="text-lg font-bold text-primary">+8 ce mois</p>
                                </div>
                            </div>
                            <div class="text-xs text-yellow-500">
                                <i class="fas fa-arrow-up"></i> 5%
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chapitres Stats -->
                <div class="glass-effect p-6 rounded-2xl card-shadow">
                    <h3 class="text-xl font-bold text-secondary mb-4">État des Chapitres</h3>
                    <div class="space-y-4">
                        <!-- Status des Chapitres -->
                        <div class="flex items-center justify-between p-3 bg-white bg-opacity-50 rounded-xl">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-primary bg-opacity-20 flex items-center justify-center">
                                    <i class="fas fa-book-open text-primary"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Chapitres Actifs</p>
                                    <p class="text-lg font-bold text-primary">12 sur 15</p>
                                </div>
                            </div>
                            <div class="text-xs text-primary">
                                3 inactifs
                            </div>
                        </div>

                        <!-- Contenu Premium -->
                        <div class="flex items-center justify-between p-3 bg-white bg-opacity-50 rounded-xl">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-secondary bg-opacity-20 flex items-center justify-center">
                                    <i class="fas fa-lock text-secondary"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Contenu Premium</p>
                                    <p class="text-lg font-bold text-primary">8 chapitres</p>
                                </div>
                            </div>
                            <div class="text-xs text-secondary">
                                53% du contenu
                            </div>
                        </div>

                        <!-- Dernière Mise à Jour -->
                        <div class="flex items-center justify-between p-3 bg-white bg-opacity-50 rounded-xl">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                                    <i class="fas fa-clock text-purple-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Dernière Mise à Jour</p>
                                    <p class="text-lg font-bold text-primary">Il y a 2 jours</p>
                                </div>
                            </div>
                            <div class="text-xs text-purple-500">
                                Chapitre 15
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
