<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - YouStudy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --orange-primary: #FF7D29;
            --orange-light: #FFBF78;
            --yellow-light: #FFEEA9;
            --cream: #FEFFD2;
            --white: #FFFFFF;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .hover-scale {
            transition: all 0.3s ease;
        }
        
        .hover-scale:hover {
            transform: scale(1.02);
        }

        .progress-animation {
            transition: width 1s ease-in-out;
        }

        .card-shadow {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .sidebar-link {
            transition: all 0.3s ease;
        }

        .sidebar-link:hover {
            background: var(--orange-primary);
            color: white;
            transform: translateX(10px);
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--orange-primary), var(--orange-light));
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'orange-primary': '#FF7D29',
                        'orange-light': '#FFBF78',
                        'yellow-light': '#FFEEA9',
                        'cream': '#FEFFD2',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-cream">
    <div class="flex">
        @include('layouts.navUser')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto p-4 md:p-8">
            <!-- Header -->
            <div class="bg-white rounded-2xl p-4 md:p-8 mb-8 card-shadow hover-scale">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-orange-primary mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-gray-600">Your learning journey continues here</p>
                    </div>
                    <button class="bg-orange-primary text-white px-6 py-3 rounded-xl hover:bg-orange-light transition-all">
                        <i class="fas fa-crown mr-2"></i>Premium Active
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl card-shadow hover-scale">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-600 font-medium">Overall Progress</span>
                        <span class="text-2xl font-bold text-orange-primary">75%</span>
                    </div>
                    <div class="w-full bg-yellow-light rounded-full h-3">
                        <div class="bg-orange-primary h-3 rounded-full progress-animation" style="width: 75%"></div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl card-shadow hover-scale">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-600 font-medium">Quiz Success Rate</span>
                        <span class="text-2xl font-bold text-emerald-600">82%</span>
                    </div>
                    <div class="w-full bg-yellow-light rounded-full h-3">
                        <div class="bg-green-500 h-3 rounded-full" style="width: 82%"></div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl card-shadow hover-scale">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-600 font-medium">Completed Courses</span>
                        <span class="text-2xl font-bold text-purple-600">12/15</span>
                    </div>
                    <div class="w-full bg-yellow-light rounded-full h-3">
                        <div class="bg-red-500 h-3 rounded-full" style="width: 80%"></div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <h2 class="text-xl md:text-2xl font-bold text-orange-primary mb-6">Recent Activities</h2>
            <div class="bg-white rounded-2xl card-shadow overflow-hidden mb-16 md:mb-0">
                <div class="p-4 hover:bg-cream transition-all border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 rounded-xl bg-yellow-light">
                                <i class="fas fa-check text-orange-primary"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Completed Quiz</p>
                                <p class="text-sm text-gray-500">Mathematics - Chapter 3</p>
                            </div>
                        </div>
                        <span class="text-sm text-gray-400">2 hours ago</span>
                    </div>
                </div>

                <div class="p-4 hover:bg-cream transition-all border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 rounded-xl bg-yellow-light">
                                <i class="fas fa-play text-orange-primary"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Watched Video Lesson</p>
                                <p class="text-sm text-gray-500">Physics - Introduction to Forces</p>
                            </div>
                        </div>
                        <span class="text-sm text-gray-400">5 hours ago</span>
                    </div>
                </div>

                <div class="p-4 hover:bg-cream transition-all border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 rounded-xl bg-yellow-light">
                                <i class="fas fa-robot text-orange-primary"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">AI Assistant Used</p>
                                <p class="text-sm text-gray-500">Help with Mathematics Problem</p>
                            </div>
                        </div>
                        <span class="text-sm text-gray-400">Yesterday</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>