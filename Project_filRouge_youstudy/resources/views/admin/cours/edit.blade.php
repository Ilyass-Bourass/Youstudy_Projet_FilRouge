
<?php
 //dd($cour);
?>

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
                            Gestion des <span class="text-primary">Cours</span>
                        </h1>
                        <p class="text-gray-600">Gérez les cours et leurs parties par niveau</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button onclick="openModal()" class="px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-xl hover:opacity-90 transition-all shadow-lg">
                            <i class="fas fa-plus mr-2"></i>Nouveau Cours
                        </button>
                    </div>
                </div>
            </div>

           
           


            <!-- Modal Modifier Cours -->
            <div id="courseModal" class="fixed inset-0 bg-black bg-opacity-50 z-50">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="glass-effect rounded-2xl p-6 w-full max-w-2xl max-h-screen overflow-y-auto">

                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Erreur !</strong>
                                <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-secondary">Modifier un  Cours</h3>
                            <button onclick="window.location.href='{{ route('cours') }}'" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <form action="{{Route('update_cour',$cour->id)}}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')
                            <!-- order de cour -->
                            <div>
                                <label for="order" class="block text-gray-700 mb-2">Ordre</label>
                                <input id="order" type="number" value={{$cour->id}} name="order_cour" min="1" placeholder="Ordre" 
                                       class="px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary">
                            </div>
                            <!-- Niveau -->
                            <div>
                                <label class="block text-gray-700 mb-2">Niveau</label>
                                <select name="niveau" required 
                                        class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary">
                                    <option value="">Sélectionnez le niveau</option>
                                    <option value="tron_commun" {{$cour->niveau==='tron_commun' ? 'selected' : ''}}>Tronc Commun</option>
                                    <option value="premier_bac" {{$cour->niveau==='premier_bac' ? 'selected' : ''}}>1ère Bac</option>
                                    <option value="deuxieme_bac" {{$cour->niveau==='deuxieme_bac' ? 'selected' : ''}}>2ème Bac</option>
                                </select>
                            </div>

                            <!-- Matière -->
                            <div>
                                <label class="block text-gray-700 mb-2">Matière (vous n'avez pas la possiblité de modifier ça )</label>
                                <select name="matiere_cour" required
                                        class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary">
                                    <option value="">Sélectionnez la matière</option>
                                    <option value="math" {{$cour->matiere_cour==='math' ? 'selected' : ''}}>Mathématiques</option>
                                    <option value="pc" {{$cour->matiere_cour==='pc' ? 'selected' : ''}}>Physique-Chimie</option>
                                    <option value="svt" {{$cour->matiere_cour==='svt' ? 'selected' : ''}}>SVT</option>
                                </select>
                            </div>

                            <!-- Titre du cours -->
                            <div>
                                <label class="block text-gray-700 mb-2">Titre du cours</label>
                                <input type="text" name="titre" value={{$cour->titre}} required
                                       class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                       placeholder="Ex: Fonctions Numériques">
                            </div>

                            <!-- Description -->
                            <div>
                                <label class="block text-gray-700 mb-2">Description (optionnelle)</label>
                                <textarea name="description" rows="3" 
                                          class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                          placeholder="Description du cours...">{{$cour->description}}</textarea>
                            </div>

                            <!-- Boutons -->
                            <div class="flex justify-end space-x-4">
                                <button type="button" onclick="window.location.href='{{ route('cours') }}'"
                                        class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50">
                                    Annuler
                                </button>
                                <button type="submit"
                                        class="px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-xl hover:opacity-90">
                                    Modifier le cours
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

         

           


            
          

            <!-- JavaScript pour le modal -->
            <script>
                function openModal() {
                    document.getElementById('courseModal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }

                function closeModal() {
                    document.getElementById('courseModal').classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }


        
            </script>
        </div>
    </div>
</body>
</html>
