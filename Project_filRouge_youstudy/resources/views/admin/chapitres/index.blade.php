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
                            Gestion des <span class="text-primary">Chapitres</span>
                        </h1>
                        <p class="text-gray-600">Gérez le contenu des chapitres et leurs cours vidéo</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="#"
                            class="px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-xl hover:opacity-90 transition-all shadow-lg">
                            <i class="fas fa-plus mr-2"></i>Nouveau Chapitre
                        </a>
                    </div>
                </div>
            </div>

            <!-- Messages de succès et d'erreur -->
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

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Chapitres -->
                <div class="glass-effect p-6 rounded-2xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600">Total Chapitres</p>
                            <h3 class="text-3xl font-bold text-primary mt-1">
                                {{ $totalParties }}</h3>
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
                            <p class="text-gray-600">Cours Vidéo Premium</p>
                            <h3 class="text-3xl font-bold text-secondary mt-1">
                                {{ $statistiques['total_videos'] ?? '—' }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-secondary bg-opacity-10 flex items-center justify-center">
                            <i class="fas fa-video text-secondary text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Chapitres par niveau -->
                <div class="glass-effect p-6 rounded-2xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600">Chapitres par Niveau</p>
                            <div class="flex mt-2 space-x-3">
                                <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded-lg text-sm">TC:
                                    {{ $statistiques['tc_count'] ?? '—' }}</span>
                                <span class="px-2 py-1 bg-green-100 text-green-600 rounded-lg text-sm">1BAC:
                                    {{ $statistiques['1bac_count'] ?? '—' }}</span>
                                <span class="px-2 py-1 bg-purple-100 text-purple-600 rounded-lg text-sm">2BAC:
                                    {{ $statistiques['2bac_count'] ?? '—' }}</span>
                            </div>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-layer-group text-gray-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chapitres List -->
            <div class="glass-effect rounded-2xl p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-xl font-bold text-secondary mb-4 md:mb-0">Liste des Chapitres</h2>
                    <div class="flex flex-col md:flex-row md:space-x-4 space-y-2 md:space-y-0">
                        <div class="relative">
                            <input type="text" id="search" placeholder="Rechercher..."
                                class="pl-10 pr-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary w-full">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <select id="niveau-filter"
                            class="px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary">
                            <option value="">Tous les niveaux</option>
                            <option value="tron_commun">Tronc Commun</option>
                            <option value="premier_bac">1ère BAC</option>
                            <option value="deuxieme_bac">2ème BAC</option>
                        </select>
                        <select id="matiere-filter"
                            class="px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary">
                            <option value="">Toutes les matières</option>
                            <option value="math">Mathématiques</option>
                            <option value="pc">Physique-Chimie</option>
                            <option value="svt">SVT</option>
                        </select>
                    </div>
                </div>

                <!-- Table des chapitres -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b border-primary border-opacity-20">
                                <th class="pb-4 text-gray-600">Titre_chapitre</th>
                                <th class="pb-4 text-gray-600">Titre_Cour</th>
                                <th class="pb-4 text-gray-600">Matière</th>
                                <th class="pb-4 text-gray-600">Niveau</th>
                                <th class="pb-4 text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-primary divide-opacity-20">
                            <!-- Chapitre 1 -->
                            @foreach ($parties as $partie)
                                <tr class="hover:bg-white hover:bg-opacity-50 transition-colors">
                                    <td class="py-4">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-primary bg-opacity-10 flex items-center justify-center">
                                                <i class="fas fa-book-open text-primary"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium">{{ $partie->titre }}</p>
                                                <p class="text-sm text-gray-500">Cour {{ $partie->order_cour }} du
                                                    {{ $partie->niveau }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <p class="font-medium">{{ $partie->cours_titre }}</p>
                                    </td>
                                    <td class="py-4">
                                        <span
                                            class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">{{ $partie->matiere_cour }}</span>
                                    </td>
                                    <td class="py-4">
                                        <span
                                            class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">{{ $partie->niveau }}</span>
                                    </td>
                                    <td class="py-4">
                                        <div class="flex space-x-2">

                                            <button onclick="openPartieModal({{ $partie->id }})"
                                                class="p-2 text-green-500 hover:bg-green-100 rounded-lg transition-colors"
                                                title="Ajouter des parties">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a href="#"
                                                class="p-2 text-blue-500 hover:bg-blue-100 rounded-lg transition-colors"
                                                title="Voir détails">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('deletePartieCour',$partie->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                
                                                <button type="submit" class="p-2 text-red-500 hover:bg-red-100 rounded-lg transition-colors" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
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

                    <form action="{{ route('updatePartieCour') }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="partie_id_input" name="partie_id" class="hidden">
                        <!-- Informations de base -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 glass-effect rounded-xl">
                            <div>
                                <label class="block text-gray-700 mb-2">Titre de la partie</label>
                                <input type="text" name="titre" id="titre"
                                    class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                    placeholder="Ex: Introduction aux limites">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Ordre</label>
                                <input type="number" name="order" id='order' min="1"
                                    class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                    placeholder="Ex: 1">
                            </div>
                        </div>

                        <!-- Contenu Théorique -->
                        <div class="space-y-4 p-4 glass-effect rounded-xl">
                            <h4 class="text-lg font-semibold text-primary">Contenu Théorique</h4>

                            <div>
                                <label class="block text-gray-700 mb-2">Définition</label>
                                <textarea class="tinymce" name="contenu_definition" id='contenu_definition' rows="3"
                                    class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                    placeholder="Entrez la définition..."></textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700 mb-2">Propriété</label>
                                <textarea class="tinymce" name="contenu_propriete" id='contenu_propriete' rows="3"
                                    class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                    placeholder="Entrez la propriété..."></textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700 mb-2">Exemple</label>
                                <textarea class="tinymce" name="contenu_exemple" id='contenu_exemple' rows="3"
                                    class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                    placeholder="Entrez l'exemple..."></textarea>
                            </div>
                        </div>

                        <!-- Vidéo du cours -->
                        <div class="space-y-4 p-4 glass-effect rounded-xl">
                            <h4 class="text-lg font-semibold text-primary">Vidéo du cours</h4>

                            <div>
                                <label class="block text-gray-700 mb-2">URL de la vidéo</label>
                                <input type="url" name="url_video" id='url_video'
                                    class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                    placeholder="https://...">
                            </div>

                        </div>

                        <!-- Exercice -->
                        <div class="space-y-4 p-4 glass-effect rounded-xl">
                            <h4 class="text-lg font-semibold text-primary">Exercice</h4>

                            <div>
                                <label class="block text-gray-700 mb-2">Énoncé de l'exercice</label>
                                <textarea class="tinymce" name="contenu_exercice" id='contenu_exercice' rows="4"
                                    class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                    placeholder="Entrez l'énoncé..."></textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700 mb-2">Solution Vidéo (URL)</label>
                                <input type="url" name="solution_exercice_video" id='solution_exercice_video'
                                    class="w-full px-4 py-2 rounded-xl bg-white bg-opacity-50 border border-primary border-opacity-20 focus:outline-none focus:border-secondary"
                                    placeholder="https://...">
                            </div>

                            <div>
                                <label class="block text-gray-700 mb-2">Solution Détaillée</label>
                                <textarea class="tinymce" name="solution_exercice_text" id='solution_exercice_text' rows="4"
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


        <script>
            // Initialisation TinyMCE avec support pour les formules mathématiques
            document.addEventListener('DOMContentLoaded', function() {
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
                                    // Rendu immédiat des formules
                                    setTimeout(function() {
                                        if (typeof MathJax !== 'undefined') {
                                            MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                                        }
                                    }, 100);
                                }
                            }
                        });

                        // Après avoir chargé du contenu, rafraîchir MathJax
                        editor.on('SetContent', function() {
                            if (typeof MathJax !== 'undefined') {
                                MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                            }
                        });
                    },
                    extended_valid_elements: 'script[src|async|defer|type|charset]',
                    // Permettre le HTML brut pour conserver les formules mathématiques
                    entity_encoding: 'raw'
                });
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

            function openPartieModal(partie_id) {
                document.getElementById('partieModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                const partieIdInput = document.getElementById('partie_id_input');
                const titreInput = document.getElementById('titre');
                const orderInput = document.getElementById('order');
                const contenuDefinitionInput = document.getElementById('contenu_definition');
                const contenuProprieteInput = document.getElementById('contenu_propriete');
                const contenuExempleInput = document.getElementById('contenu_exemple');
                const urlVideoInput = document.getElementById('url_video');
                const contenuExerciceInput = document.getElementById('contenu_exercice');
                const solutionExerciceVideoInput = document.getElementById('solution_exercice_video');
                const solutionExerciceTextInput = document.getElementById('solution_exercice_text');

                fetch('/showPartieFetch/' + partie_id)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            partieIdInput.value = data.id;
                            titreInput.value = data.titre;
                            orderInput.value = data.order;

                            // Mettre le contenu dans les éditeurs TinyMCE
                            if (tinymce.get('contenu_definition')) {
                                tinymce.get('contenu_definition').setContent(data.contenu_definition || '');
                            }
                            if (tinymce.get('contenu_propriete')) {
                                tinymce.get('contenu_propriete').setContent(data.contenu_propriete || '');
                            }
                            if (tinymce.get('contenu_exemple')) {
                                tinymce.get('contenu_exemple').setContent(data.contenu_exemple || '');
                            }
                            if (tinymce.get('contenu_exercice')) {
                                tinymce.get('contenu_exercice').setContent(data.contenu_exercice || '');
                            }
                            if (tinymce.get('solution_exercice_text')) {
                                tinymce.get('solution_exercice_text').setContent(data.solution_exercice_text || '');
                            }

                            // Pour les champs non-TinyMCE
                            urlVideoInput.value = data.url_video || '';
                            solutionExerciceVideoInput.value = data.solution_exercice_video || '';

                            // Initialiser MathJax pour rendre les formules mathématiques
                            setTimeout(function() {
                                if (typeof MathJax !== 'undefined') {
                                    MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                                }
                            }, 500);
                        }
                    })
                    .catch(error => console.error('Erreur:', error));
            }

            function closePartieModal() {
                document.getElementById('partieModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        </script>

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
</body>

</html>
