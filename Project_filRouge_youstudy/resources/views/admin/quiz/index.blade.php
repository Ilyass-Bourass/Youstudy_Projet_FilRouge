<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Quiz - YouStudy</title>
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
                            Gestion des <span class="text-primary">Quiz</span>
                        </h1>
                        <p class="text-gray-600">Gérez les quiz pour chaque partie de cours</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button onclick="showQuizAlert()"
                            class="px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-xl hover:opacity-90 transition-all shadow-lg">
                            <i class="fas fa-plus mr-2"></i>Nouveau Quiz
                        </button>
                        <script>
                            function showQuizAlert() {
                                alert("Les quiz sont automatiquement créés avec les chapitres. Pour ajouter un nouveau quiz, veuillez créer un nouveau chapitre dans l'espace de gestion des cours.");
                            }
                        </script>
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
                <!-- Total Quiz -->
                <div class="glass-effect p-6 rounded-2xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600">Total Quiz</p>
                            <h3 class="text-3xl font-bold text-primary mt-1">12</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-primary bg-opacity-10 flex items-center justify-center">
                            <i class="fas fa-question-circle text-primary text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Questions -->
                <div class="glass-effect p-6 rounded-2xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600">Total Questions</p>
                            <h3 class="text-3xl font-bold text-secondary mt-1">48</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-secondary bg-opacity-10 flex items-center justify-center">
                            <i class="fas fa-tasks text-secondary text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Quiz par niveau -->
                <div class="glass-effect p-6 rounded-2xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600">Quiz par Niveau</p>
                            <div class="flex mt-2 space-x-3">
                                <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded-lg text-sm">TC: 4</span>
                                <span class="px-2 py-1 bg-green-100 text-green-600 rounded-lg text-sm">1BAC: 3</span>
                                <span class="px-2 py-1 bg-purple-100 text-purple-600 rounded-lg text-sm">2BAC: 5</span>
                            </div>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-layer-group text-gray-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quiz List -->
            <div class="glass-effect rounded-2xl p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-xl font-bold text-secondary mb-4 md:mb-0">Liste des Quiz</h2>
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

                <!-- Table des quiz - Version modernisée -->
                <div class="overflow-x-auto">
                    <table class="min-w-full rounded-xl overflow-hidden">
                        <thead>
                            <tr class="bg-gradient-to-r from-primary/20 to-secondary/20 text-left">
                                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Titre Partie Quiz</th>
                                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Nombre de questions</th>
                                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Matière</th>
                                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Niveau</th>
                                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($quizzes as $index => $quiz)
                                <tr
                                    class="border-b border-primary/10 hover:bg-gradient-to-r hover:from-yellow-50 hover:to-cream transition-all duration-200">
                                    <td class="px-6 py-3">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary to-secondary/70 flex items-center justify-center shadow-md shadow-primary/20">
                                                <i class="fas fa-book-reader text-white"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">{{ $quiz->partieCour->titre }}</p>
                                                <p class="text-xs text-gray-500">Quiz #{{ $index + 1 }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-3">
                                        <div class="flex items-center">
                                            <span
                                                class="bg-primary/10 text-primary rounded-full w-8 h-8 flex items-center justify-center mr-2">
                                                <span class="text-lg font-medium">{{ count($quiz->questions) }}</span>
                                            </span>
                                            <span class="text-sm text-primary/80 font-medium ml-1">questions</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-3">
                                        <div
                                            class="inline-flex items-center px-2.5 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-medium">
                                            <i class="fas fa-book mr-1.5"></i>
                                            {{ $quiz->partieCour->cour->matiere_cour }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-3">
                                        <div
                                            class="inline-flex items-center px-2.5 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">
                                            <i class="fas fa-graduation-cap mr-1.5"></i>
                                            {{ $quiz->partieCour->cour->niveau }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-3">
                                        <div class="flex items-center space-x-3">
                                            <button onclick="openModaleditQuiz({{ $quiz->partieCour->id }})"
                                                class="group relative rounded-full p-2 bg-green-50 hover:bg-green-100 transition-colors"
                                                title="Modifier">
                                                <i class="fas fa-edit text-green-600"></i>
                                                <span
                                                    class="absolute -top-8 left-1/2 -translate-x-1/2 w-max py-1 px-2 bg-gray-800 text-xs text-white rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300">Modifier</span>
                                            </button>
                                            <button onclick="showDeleteAlert()"
                                                class="group relative rounded-full p-2 bg-red-50 hover:bg-red-100 transition-colors"
                                                title="Supprimer">
                                                <i class="fas fa-trash text-red-600"></i>
                                                <span
                                                    class="absolute -top-8 left-1/2 -translate-x-1/2 w-max py-1 px-2 bg-gray-800 text-xs text-white rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300">Supprimer</span>
                                            </button>

                                            <script>
                                            function showDeleteAlert() {
                                                alert("Lorsque vous supprimez un quiz, le chapitre associé sera également supprimé. Cette action est irréversible.");
                                            }
                                            </script>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div
                                                class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                                                <i class="fas fa-question-circle text-gray-400 text-2xl"></i>
                                            </div>
                                            <p class="text-gray-500 font-medium">Aucun quiz trouvé</p>
                                            <p class="text-gray-400 text-sm mt-1">Créez un nouveau quiz pour commencer
                                            </p>
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

    <!-- Modal pour éditer un quiz -->
    <div id="editQuizModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="absolute inset-0 bg-black opacity-50" onclick="closeQuizModal()"></div>
        <div class="glass-effect rounded-2xl p-8 max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto relative z-10">
            <button onclick="closeQuizModal()"
                class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-xl">
                <i class="fas fa-times"></i>
            </button>

            <h2 class="text-2xl font-bold text-secondary mb-6">Modifier le Quiz: <span id="quizTitle"
                    class="text-primary"></span></h2>

            <form action='{{ route('updateQuestionsQuiz') }}' id="editQuizForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="quiz_id" id="quiz_id">

                <div id="questionsContainer" class="space-y-6">
                    <!-- Les questions seront ajoutées ici dynamiquement -->
                </div>

                <div class="mt-8 flex justify-between">
                    <button type="button" id="addQuestionBtn"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        <i class="fas fa-plus mr-2"></i>Ajouter une question
                    </button>
                    <div>
                        <button type="button" onclick="closeQuizModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 mr-2">
                            Annuler
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-lg hover:opacity-90">
                            Enregistrer les modifications
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Define the function in the global scope so it can be called from inline onclick
        function openModaleditQuiz(id) {
            // Afficher la modal
            document.getElementById('editQuizModal').classList.remove('hidden');
            document.getElementById('quiz_id').value = id;

            // Récupérer les données du quiz
            fetch('/showQuestionsfetch/' + id)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        // Définir le titre du quiz
                        document.getElementById('quizTitle').textContent = data[0].quiz.partie_cour.titre;

                        // Vider le conteneur de questions
                        const questionsContainer = document.getElementById('questionsContainer');
                        questionsContainer.innerHTML = '';

                        // Ajouter chaque question au formulaire
                        data.forEach((item, index) => {
                            const questionCard = createQuestionCard(item, index);
                            questionsContainer.appendChild(questionCard);
                        });
                    }
                })
                .catch(error => console.error('Error fetching quiz data:', error));
        }

        function createQuestionCard(questionData, index) {
            // Créer un élément div pour la question
            const questionDiv = document.createElement('div');
            questionDiv.className = 'bg-white p-6 rounded-xl shadow-md question-card';

            // Construire le HTML pour la question et ses propositions
            questionDiv.innerHTML = `
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-primary">Question ${index + 1}</h3>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeQuestion(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <input type="hidden" name="question_id[]" value="${questionData.id}">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Texte de la question</label>
                    <input type="text" name="question_text[]" value="${questionData.question}" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-medium text-gray-700">Propositions</label>
                        <div>
                            <label class="text-sm font-medium text-gray-700 mr-2">Réponse correcte:</label>
                            <select name="correct_answer_${questionData.id}" class="p-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                                <option value="1" ${questionData.correct_answer == 1 ? 'selected' : ''}>1</option>
                                <option value="2" ${questionData.correct_answer == 2 ? 'selected' : ''}>2</option>
                                <option value="3" ${questionData.correct_answer == 3 ? 'selected' : ''}>3</option>
                            </select>
                        </div>
                    </div>
                    ${questionData.propositions.map((proposition, propIndex) => `
                            <div class="flex items-center space-x-2">
                                <div class="flex-none w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center text-primary font-medium">
                                    ${propIndex + 1}
                                </div>
                                <input type="text" name="proposition_${questionData.id}[]" value="${proposition}" class="flex-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                            </div>
                        `).join('')}
                </div>
            `;

            return questionDiv;
        }

        function closeQuizModal() {
            document.getElementById('editQuizModal').classList.add('hidden');
        }

        function removeQuestion(button) {
            const questionCard = button.closest('.question-card');
            if (confirm('Êtes-vous sûr de vouloir supprimer cette question?')) {
                questionCard.remove();
            }
        }

        document.getElementById('addQuestionBtn').addEventListener('click', function() {
            const questionsContainer = document.getElementById('questionsContainer');
            const questionCount = questionsContainer.children.length;

            // Créer un nouvel élément de question vide
            const newQuestionCard = document.createElement('div');
            newQuestionCard.className = 'bg-white p-6 rounded-xl shadow-md question-card';

            newQuestionCard.innerHTML = `
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-primary">Nouvelle Question</h3>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeQuestion(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <input type="hidden" name="question_id[]" value="new">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Texte de la question</label>
                    <input type="text" name="question_text[]" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-medium text-gray-700">Propositions</label>
                        <div>
                            <label class="text-sm font-medium text-gray-700 mr-2">Réponse correcte:</label>
                            <select name="correct_answer_new_${questionCount}" class="p-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="flex-none w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center text-primary font-medium">
                            1
                        </div>
                        <input type="text" name="proposition_new_${questionCount}[]" class="flex-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Proposition 1">
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="flex-none w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center text-primary font-medium">
                            2
                        </div>
                        <input type="text" name="proposition_new_${questionCount}[]" class="flex-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Proposition 2">
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="flex-none w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center text-primary font-medium">
                            3
                        </div>
                        <input type="text" name="proposition_new_${questionCount}[]" class="flex-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Proposition 3">
                    </div>
                </div>
            `;

            questionsContainer.appendChild(newQuestionCard);
        });

        // Fonctions pour les filtres si nécessaire
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const niveauFilter = document.getElementById('niveau-filter');
            const matiereFilter = document.getElementById('matiere-filter');

            // Implémentation du filtrage statique
        });
    </script>
</body>

</html>
