<div class="bg-white p-4 md:p-6 rounded-2xl card-shadow h-fit lg:sticky lg:top-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">À propos : Mathématiques</h2>
                    
                    <!-- Progress Section -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-2">Progression</h3>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-2xl font-bold text-orange-primary">0%</span>
                            <span class="text-sm text-gray-500">Étapes 0/5</span>
                        </div>
                        <div class="w-full bg-yellow-light rounded-full h-2">
                            <div class="bg-orange-primary h-2 rounded-full progress-animation" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="space-y-3">
                        <a href="{{ route('ContenuCour') }}" class="block p-3 rounded-xl @if(request()->routeIs('ContenuCour')) bg-orange-primary text-white @else bg-gray-100 text-orange-primary @endif hover:bg-orange-primary hover:text-white transition-all">
                            <div class="flex justify-between items-center">
                                <span>Cours</span>
                                <i class="fas fa-play text-sm"></i>
                            </div>
                        </a>

                        <a href="{{ route('quizPartie') }}" class="block p-3 rounded-xl @if(request()->routeIs('quizPartie')) bg-orange-primary text-white @else bg-gray-100 text-orange-primary @endif hover:bg-orange-primary hover:text-white transition-all">
                            <div class="flex justify-between items-center">
                                <span>Mini Quiz</span>
                                <i class="fas fa-chevron-right text-sm"></i>
                            </div>
                        </a>

                        <a href="{{ route('exercicesPartie') }}" class="block p-3 rounded-xl @if(request()->routeIs('exercicesPartie')) bg-orange-primary text-white @else bg-gray-100 text-orange-primary @endif hover:bg-orange-primary hover:text-white transition-all">
                            <div class="flex justify-between items-center">
                                <span>Exercices</span>
                                <i class="fas fa-chevron-right text-sm"></i>
                            </div>
                        </a>
                    </div>
                </div>