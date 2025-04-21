

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
                        <h1 class="text-2xl md:text-3xl font-bold text-orange-primary mb-2">Welcome back, Sarah! 👋</h1>
                        <p class="text-gray-600">Your learning journey continues here</p>
                    </div>
                    <button class="bg-orange-primary text-white px-4 md:px-6 py-2 md:py-3 rounded-xl hover:bg-orange-light transition-all">
                        <i class="fas fa-crown mr-2"></i>Premium Active
                    </button>
                </div>
            </div>

            <!-- Current Courses -->
            <h2 class="text-xl md:text-2xl font-bold text-orange-primary mb-4 md:mb-6">Current Courses</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
                <!-- Mathematics Card -->
                <div class="bg-white p-4 md:p-6 rounded-2xl card-shadow hover-scale">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="p-3 rounded-xl bg-yellow-light">
                                <i class="fas fa-calculator text-orange-primary"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Mathematics</h3>
                                <p class="text-sm text-gray-500">Advanced Level</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-light text-orange-primary">
                            In Progress
                        </span>
                    </div>
                    <div class="mb-4">
                        <div class="w-full bg-yellow-light rounded-full h-2">
                            <div class="bg-orange-primary h-2 rounded-full progress-animation" style="width: 65%"></div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">
                            <i class="far fa-clock mr-1"></i>2h 30m left
                        </span>
                        <a href="{{ route('partie_cour') }}" class="bg-orange-primary text-white px-4 py-2 rounded-xl text-sm hover:bg-orange-light transition-all">
                            Continue →
                        </a>
                    </div>
                </div>

                <!-- Physics Card -->
                <div class="bg-white p-4 md:p-6 rounded-2xl card-shadow hover-scale">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="p-3 rounded-xl bg-yellow-light">
                                <i class="fas fa-atom text-orange-primary"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Physics</h3>
                                <p class="text-sm text-gray-500">Advanced Level</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-light text-orange-primary whitespace-nowrap">
                            In Progress
                        </span>
                    </div>
                    <div class="mb-4">
                        <div class="w-full bg-yellow-light rounded-full h-2">
                            <div class="bg-orange-primary h-2 rounded-full progress-animation" style="width: 45%"></div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">
                            <i class="far fa-clock mr-1"></i>3h 45m left
                        </span>
                        <a href="{{ route('partie_cour') }}" class="bg-orange-primary text-white px-4 py-2 rounded-xl text-sm hover:bg-orange-light transition-all">
                            Continue →
                        </a>
                    </div>
                </div>

                <!-- Biology Card -->
                <div class="bg-white p-4 md:p-6 rounded-2xl card-shadow hover-scale">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="p-3 rounded-xl bg-yellow-light">
                                <i class="fas fa-dna text-orange-primary"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Biology (SVT)</h3>
                                <p class="text-sm text-gray-500">New</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-light text-orange-primary">
                            New
                        </span>
                    </div>
                    <div class="mb-4">
                        <div class="w-full bg-yellow-light rounded-full h-2">
                            <div class="bg-gray-300 h-2 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">
                            <i class="far fa-clock mr-1"></i>5h total
                        </span>
                        <a href="{{ route('partie_cour') }}" class="bg-green-500 text-white px-4 py-2 rounded-xl text-sm hover:bg-orange-light transition-all">
                            Start Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>