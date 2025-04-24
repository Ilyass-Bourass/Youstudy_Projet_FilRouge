<?php
 //dd($cours);
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs - YouStudy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>
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
                        <button onclick="openModal()"
                            class="px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-xl hover:opacity-90 transition-all shadow-lg">
                            <i class="fas fa-plus mr-2"></i>Nouveau Cours
                        </button>
                    </div>
                </div>
            </div>

            <!-- Liste des Cours -->
            <div class="glass-effect rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-secondary">Liste des Cours</h2>
                    <div class="flex space-x-4">
                        <!-- Filtre Niveau -->


                        <select
                            class="px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary">
                            <option value="">Tous les niveaux</option>
                            <option value="tron_commun">Tronc Commun</option>
                            <option value="premier_bac">1ère Bac</option>
                            <option value="deuxieme_bac">2ème Bac</option>
                        </select>

                        <!-- Filtre Matière -->
                        <select
                            class="px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary">
                            <option value="">Toutes les matières</option>
                            <option value="math">Mathématiques</option>
                            <option value="pc">Physique-Chimie</option>
                            <option value="svt">SVT</option>
                        </select>

                        <!-- Recherche -->
                        <div class="relative">
                            <input type="text" placeholder="Rechercher un cours..."
                                class="pl-10 pr-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Table des cours - Version modernisée -->
                <div class="overflow-x-auto">
                    <table class="min-w-full rounded-xl overflow-hidden">
                        <thead>
                            <tr class="bg-gradient-to-r from-primary/20 to-secondary/20 text-left">
                                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Titre du Cours</th>
                                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Niveau</th>
                                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Matière</th>
                                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Parties</th>
                                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cours as $cour)
                                <tr
                                    class="border-b border-primary/10 hover:bg-gradient-to-r hover:from-yellow-50 hover:to-cream transition-all duration-200">
                                    <td class="px-6 py-3">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary to-secondary/70 flex items-center justify-center shadow-md shadow-primary/20">
                                                <i class="fas fa-book text-white"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">{{ $cour->titre }}</p>
                                                <p class="text-xs text-gray-500">Cours #{{ $cour->order_cour }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-3">
                                        <div
                                            class="inline-flex items-center px-2.5 py-1 
                                            @if ($cour->niveau == 'tron_commun') bg-yellow-100 text-yellow-800 
                                            @elseif($cour->niveau == 'premier_bac') bg-green-100 text-green-800 
                                            @else bg-purple-100 text-purple-800 @endif 
                                            rounded-full text-xs font-medium">
                                            <i class="fas fa-graduation-cap mr-1.5"></i>
                                            {{ $cour->niveau }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-3">
                                        <div
                                            class="inline-flex items-center px-2.5 py-1
                                            @if ($cour->matiere_cour == 'math') bg-blue-100 text-blue-600
                                            @elseif($cour->matiere_cour == 'pc') bg-indigo-100 text-indigo-600
                                            @else bg-green-100 text-green-600 @endif
                                            rounded-full text-xs font-medium">
                                            <i class="fas fa-atom mr-1.5"></i>
                                            {{ $cour->matiere_cour }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-3">
                                        <div
                                            class="inline-flex items-center px-2.5 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-medium">
                                            <i class="fas fa-puzzle-piece mr-1.5 text-primary"></i>
                                            {{ $cour->partie_cour_count }} parties
                                        </div>
                                    </td>
                                    <td class="px-6 py-3">
                                        <div class="flex items-center space-x-3">
                                            <button onclick="window.location.href='{{ Route('edit_cour', $cour->id) }}'"
                                                class="group relative rounded-full p-2 bg-green-50 hover:bg-green-100 transition-colors"
                                                title="Modifier">
                                                <i class="fas fa-edit text-green-600"></i>
                                                <span
                                                    class="absolute -top-8 left-1/2 -translate-x-1/2 w-max py-1 px-2 bg-gray-800 text-xs text-white rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300">Modifier</span>
                                            </button>
                                            <button onclick="openPartieModal({{ $cour->id }})"
                                                class="group relative rounded-full p-2 bg-amber-50 hover:bg-amber-100 transition-colors"
                                                title="Ajouter parties">
                                                <i class="fas fa-puzzle-piece text-amber-600"></i>
                                                <span
                                                    class="absolute -top-8 left-1/2 -translate-x-1/2 w-max py-1 px-2 bg-gray-800 text-xs text-white rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300">Ajouter
                                                    parties</span>
                                            </button>
                                            <button
                                                class="group relative rounded-full p-2 bg-blue-50 hover:bg-blue-100 transition-colors"
                                                title="Voir détails">
                                                <i class="fas fa-eye text-blue-600"></i>
                                                <span
                                                    class="absolute -top-8 left-1/2 -translate-x-1/2 w-max py-1 px-2 bg-gray-800 text-xs text-white rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300">Voir
                                                    détails</span>
                                            </button>
                                            <form method="POST" action={{ route('delete_cour', $cour->id) }}>
                                                @csrf
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if (session('success'))
                <div class="mt-4 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @error('order')
                <div class="mt-4 p-4 bg-red-100 text-red-800 rounded-lg">
                    {{ $message }}
                </div>
            @enderror


            <!-- Modal Ajout Cours -->
            <div id="courseModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="glass-effect rounded-2xl p-6 w-full max-w-2xl">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-secondary">Ajouter un Nouveau Cours</h3>
                            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <form action="{{ Route('Create_cour') }}" method="POST" class="space-y-6">
                            @csrf

                            <!-- order de cour -->
                            <div>
                                <label for="order" class="block text-gray-700 mb-2">Ordre</label>
                                <input id="order" type="number" name="order_cour" min="1"
                                    placeholder="Ordre"
                                    class="px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary">
                            </div>
                            <!-- Niveau -->
                            <div>
                                <label class="block text-gray-700 mb-2">Niveau</label>
                                <select name="niveau" required
                                    class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary">
                                    <option value="">Sélectionnez le niveau</option>
                                    <option value="tron_commun">Tronc Commun</option>
                                    <option value="premier_bac">1ère Bac</option>
                                    <option value="deuxieme_bac">2ème Bac</option>
                                </select>
                            </div>

                            <!-- Matière -->
                            <div>
                                <label class="block text-gray-700 mb-2">Matière</label>
                                <select name="matiere_cour" required
                                    class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary">
                                    <option value="">Sélectionnez la matière</option>
                                    <option value="math">Mathématiques</option>
                                    <option value="pc">Physique-Chimie</option>
                                    <option value="svt">SVT</option>
                                </select>
                            </div>

                            <!-- Titre du cours -->
                            <div>
                                <label class="block text-gray-700 mb-2">Titre du cours</label>
                                <input type="text" name="titre" required
                                    class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                    placeholder="Ex: Fonctions Numériques">
                            </div>

                            <!-- Description -->
                            <div>
                                <label class="block text-gray-700 mb-2">Description (optionnelle)</label>
                                <textarea name="description" rows="3"
                                    class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                    placeholder="Description du cours..."></textarea>
                            </div>

                            <!-- Boutons -->
                            <div class="flex justify-end space-x-4">
                                <button type="button" onclick="closeModal()"
                                    class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50">
                                    Annuler
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-xl hover:opacity-90">
                                    Créer le cours
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>






            <!-- Modal Ajout Partie -->
            <div id="partieModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="glass-effect rounded-2xl p-6 w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-secondary">Ajouter une Partie au Cours</h3>
                            <button onclick="closePartieModal()" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times "></i>
                            </button>
                        </div>

                        <form action="{{ route('addChapitre') }}" method="POST" class="space-y-8">
                            @csrf
                            <input type="text" id="cour_id_input" name="cour_id" class="hidden">
                            <!-- Informations de base -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 glass-effect rounded-xl">
                                <div>
                                    <label class="block text-gray-700 mb-2">Titre de la partie</label>
                                    <input type="text" name="titre"
                                        class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                        placeholder="Ex: Introduction aux limites">
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2">Ordre</label>
                                    <input type="number" name="order" min="1"
                                        class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                        placeholder="Ex: 1">
                                </div>
                            </div>

                            <!-- Contenu Théorique -->
                            <div class="space-y-4 p-4 glass-effect rounded-xl">
                                <h4 class="text-lg font-semibold text-primary">Contenu Théorique</h4>

                                <div>
                                    <label class="block text-gray-700 mb-2">Définition</label>
                                    <textarea class="tinymce" name="contenu_definition" rows="3"
                                        class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                        placeholder="Entrez la définition..."></textarea>
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2">Propriété</label>
                                    <textarea class="tinymce" name="contenu_propriete" rows="3"
                                        class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                        placeholder="Entrez la propriété..."></textarea>
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2">Exemple</label>
                                    <textarea class="tinymce" name="contenu_exemple" rows="3"
                                        class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                        placeholder="Entrez l'exemple..."></textarea>
                                </div>
                            </div>

                            <!-- Vidéo du cours -->
                            <div class="space-y-4 p-4 glass-effect rounded-xl">
                                <h4 class="text-lg font-semibold text-primary">Vidéo du cours</h4>

                                <div>
                                    <label class="block text-gray-700 mb-2">URL de la vidéo</label>
                                    <input type="url" name="url_video"
                                        class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                        placeholder="https://...">
                                </div>

                            </div>

                            <!-- Exercice -->
                            <div class="space-y-4 p-4 glass-effect rounded-xl">
                                <h4 class="text-lg font-semibold text-primary">Exercice</h4>

                                <div>
                                    <label class="block text-gray-700 mb-2">Énoncé de l'exercice</label>
                                    <textarea class="tinymce" name="contenu_exercice" rows="4"
                                        class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                        placeholder="Entrez l'énoncé..."></textarea>
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2">Solution Vidéo (URL)</label>
                                    <input type="url" name="solution_exercice_video"
                                        class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                        placeholder="https://...">
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2">Solution Détaillée</label>
                                    <textarea class="tinymce" name="solution_exercice_text" rows="4"
                                        class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                        placeholder="Entrez la solution..."></textarea>
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2">Difficulté</label>
                                    <select name="difficulte_exercice"
                                        class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary">
                                        <option value="facile">Facile</option>
                                        <option value="moyen">Moyen</option>
                                        <option value="difficile">Difficile</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Quiz -->
                            <div class="space-y-4 p-4 glass-effect rounded-xl">
                                <div class="flex justify-between items-center">
                                    <h4 class="text-lg font-semibold text-primary">Quiz</h4>
                                    <button type="button" onclick="addQuestion()"
                                        class="px-4 py-2 bg-green-500 text-white rounded-xl hover:bg-green-600 transition-colors">
                                        <i class="fas fa-plus mr-2"></i>Ajouter une question
                                    </button>
                                </div>

                                <!-- Container pour les questions -->
                                <div id="questions-container" class="space-y-6">
                                    <!-- Template pour une question -->
                                    <div
                                        class="question-block border border-primary border-opacity-20 rounded-xl p-4 space-y-4">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-grow">
                                                <label class="block text-gray-700 mb-2">Question</label>
                                                <textarea name="questions[0]" rows="2"
                                                    class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                                    placeholder="Entrez votre question..."></textarea>
                                            </div>
                                            <button type="button" onclick="removeQuestion(this)"
                                                class="ml-4 p-2 text-red-500 hover:bg-red-100 rounded-lg transition-colors">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Propositions -->
                                        <div class="space-y-3">
                                            <div class="flex items-center space-x-4">
                                                <span class="w-8 text-center font-semibold text-primary">1.</span>
                                                <input type="text" name="propositions[0][]"
                                                    class="flex-grow px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                                    placeholder="Proposition 1">
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <span class="w-8 text-center font-semibold text-primary">2.</span>
                                                <input type="text" name="propositions[0][]"
                                                    class="flex-grow px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                                    placeholder="Proposition 2">
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <span class="w-8 text-center font-semibold text-primary">3.</span>
                                                <input type="text" name="propositions[0][]"
                                                    class="flex-grow px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                                    placeholder="Proposition 3">
                                            </div>

                                            <!-- Sélection de la réponse correcte -->
                                            <div class="mt-4">
                                                <label class="block text-gray-700 mb-2">Réponse correcte
                                                    (indice)</label>
                                                <select name="correct_answer[0]"
                                                    class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary">
                                                    <option value="">Sélectionnez l'indice de la bonne réponse
                                                    </option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="flex justify-end space-x-4 pt-6">
                                <button type="button" onclick="closePartieModal()"
                                    class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50">
                                    Annuler
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-xl hover:opacity-90">
                                    Ajouter la partie
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- JavaScript pour le modal -->
            <script>
                // Initialisation TinyMCE avec support pour les formules mathématiques
                tinymce.init({
                    selector: 'textarea.tinymce',
                    height: 300,
                    menubar: true,
                    branding: false, // Enlève la marque TinyMCE
                    promotion: false, // Enlève les promotions
                    plugins: [
                        'lists', 'link', 'image', 'charmap', 'preview',
                        'searchreplace', 'fullscreen', 'code',
                        'insertdatetime', 'table', 'help', 'wordcount'
                    ],
                    toolbar: 'undo redo | formatselect | ' +
                        'bold italic | alignleft aligncenter alignright alignjustify | ' +
                        'bullist numlist | removeformat | code | mathjax',
                    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
                    // Ajout du support pour les formules mathématiques
                    setup: function(editor) {
                        editor.ui.registry.addButton('mathjax', {
                            text: 'f(x)',
                            tooltip: 'Insérer une formule mathématique',
                            onAction: function() {
                                const formula = prompt('Entrez votre formule LaTeX:',
                                    '\\sum_{i=1}^{n} x_i');
                                if (formula) {
                                    editor.insertContent('$$' + formula + '$$');
                                }
                            }
                        });
                    },
                    // Permet d'inclure des scripts externes dans l'éditeur pour MathJax
                    extended_valid_elements: 'script[src|async|defer|type|charset]'
                });

                // Fonctions pour les modals et les questions
                function openModal() {
                    document.getElementById('courseModal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }

                function closeModal() {
                    document.getElementById('courseModal').classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }

                let questionCount = 1;

                function addQuestion() {
                    const container = document.getElementById('questions-container');
                    const template = container.querySelector('.question-block').cloneNode(true);

                    // Réinitialiser les champs
                    template.querySelector('textarea').value = '';
                    template.querySelector('textarea').name = `questions[${questionCount}]`;

                    const inputs = template.querySelectorAll('input[type="text"]');
                    inputs.forEach((input, index) => {
                        input.value = '';
                        input.name = `propositions[${questionCount}][]`;
                    });

                    const select = template.querySelector('select');
                    select.value = '';
                    select.name = `correct_answer[${questionCount}]`;

                    // Ajouter la nouvelle question
                    container.appendChild(template);
                    questionCount++;

                    // Scroll vers la nouvelle question
                    template.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }

                function removeQuestion(button) {
                    const questionsContainer = document.getElementById('questions-container');
                    if (questionsContainer.children.length > 1) {
                        button.closest('.question-block').remove();
                    } else {
                        alert('Vous devez avoir au moins une question dans le quiz !');
                    }
                }

                function openPartieModal(cour_id) {
                    document.getElementById('partieModal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                    const courIdInput = document.getElementById('cour_id_input');
                    courIdInput.value = cour_id;
                }

                function closePartieModal() {
                    document.getElementById('partieModal').classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }
            </script>

            <!-- Ajout de MathJax pour afficher les formules mathématiques -->
            <script type="text/javascript" async
                src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML"></script>
            <script type="text/javascript">
                MathJax.Hub.Config({
                    tex2jax: {
                        inlineMath: [
                            ['$', '$'],
                            ['\\(', '\\)']
                        ],
                        displayMath: [
                            ['$$', '$$'],
                            ['\\[', '\\]']
                        ],
                        processEscapes: true
                    }
                });
            </script>
        </div>
    </div>
</body>

</html>
