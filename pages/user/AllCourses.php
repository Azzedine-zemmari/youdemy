<?php 
session_start();
require_once __DIR__."/../../class/Course.php";
$courses = course::showCourses();
// print_r( $_SESSION['nom']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPortal - Online Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <section class="min-h-screen bg-gradient-to-b from-green-50 to-white">
        <div class="container px-4 sm:px-6 2xl:px-0 mx-auto">
            <!-- Hero Section -->
            <div class="flex flex-col justify-center items-center lg:justify-between pt-10 lg:pt-20 lg:flex-row gap-12">
                <div class="max-w-[660px]" data-aos="fade-right">
                    <div class="relative group cursor-pointer">
                        <img src="/api/placeholder/600/400" alt="Learning Platform" class="relative z-10 rounded-2xl shadow-xl transition-transform group-hover:scale-105 duration-300">
                        <div class="absolute -inset-1 bg-gradient-to-r from-green-600 to-teal-600 rounded-2xl blur opacity-30 group-hover:opacity-50 transition duration-300"></div>
                        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-green-500 rounded-full animate-pulse opacity-50"></div>
                        <div class="absolute -left-4 -top-4 w-16 h-16 bg-teal-500 rounded-full animate-pulse opacity-50 delay-150"></div>
                    </div>
                </div>

                <div class="max-w-[660px]" data-aos="fade-left">
                    <h2 class="text-4xl md:text-5xl xl:text-6xl font-bold text-gray-900 mb-6">
                        Join <span class="text-green-600 relative">World's largest
                            <svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 100 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 10 Q 25 0, 50 10 T 100 10" stroke="currentColor" fill="none" stroke-width="2"/>
                            </svg>
                        </span> learning platform
                    </h2>
                    <p class="text-xl text-gray-600 mb-8">
                        Start your learning journey today with our expert-led courses
                    </p>
                    <button class="group relative inline-flex items-center px-8 py-3 text-lg font-medium text-white bg-green-600 rounded-full overflow-hidden transition-all hover:bg-green-700">
                        <span class="relative z-10">Start Learning Now</span>
                        <div class="absolute inset-0 -translate-x-full group-hover:translate-x-0 bg-gradient-to-r from-teal-600 to-green-600 transition-transform duration-300"></div>
                    </button>
                </div>
            </div>

            <!-- Course Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-20 mb-16">
                <?php foreach($courses as $course): ?>
                <!-- Course Card 1 -->
                <div class="group bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative">
                        <video  width="320" height="240"  alt="Course" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110">
                        <source src="../../uploads/<?=$course['vedeo']?>" type="video/mp4">      
                    </video>
                        <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Popular
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded"><?= $course['CategoryName'] ?></span>
                            <span class="ml-2 text-gray-500 text-sm">• 12 weeks</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2"><?= $course['titre'] ?></h3>
                        <p class="text-gray-600 mb-4"><?= $course['description'] ?></p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-green-600">$<?= $course['price'] ?></span>
                            <?php if(isset($_SESSION['userId']) && $_SESSION['role'] == 'Etudiant'): ?>
                            <a href="./description.php?id=<?= $course['idCours'] ?>" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                Read More
                            </a>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <!-- Course Card 2 -->
                <!-- <div class="group bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative">
                        <img src="/api/placeholder/400/250" alt="Course" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute top-4 right-4 bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            New
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Data Science</span>
                            <span class="ml-2 text-gray-500 text-sm">• 8 weeks</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Data Science Fundamentals</h3>
                        <p class="text-gray-600 mb-4">Learn data analysis, visualization, and machine learning basics.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-blue-600">$59.99</span>
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                Enroll Now
                            </button>
                        </div>
                    </div>
                </div> -->

                <!-- Course Card 3 -->
                <!-- <div class="group bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative">
                        <img src="/api/placeholder/400/250" alt="Course" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute top-4 right-4 bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Featured
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded">UI/UX Design</span>
                            <span class="ml-2 text-gray-500 text-sm">• 10 weeks</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">UI/UX Design Masterclass</h3>
                        <p class="text-gray-600 mb-4">Create beautiful and user-friendly interfaces that convert.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-purple-600">$69.99</span>
                            <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                                Enroll Now
                            </button>
                        </div>
                    </div>
                </div> -->
            </div>

            <!-- Pagination -->
            <div class="flex justify-center pb-20" data-aos="fade-up">
                <nav class="inline-flex rounded-lg shadow-sm">
                    <button class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-50">
                        Previous
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-green-600">
                        1
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">
                        2
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">
                        3
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-50">
                        Next
                    </button>
                </nav>
            </div>
        </div>
    </section>

    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true
        });
    </script>
</body>
</html>