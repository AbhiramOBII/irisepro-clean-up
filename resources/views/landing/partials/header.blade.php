<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iRisePro - Career Acceleration Platform</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#F58321',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <!-- Google Fonts - Poppins (Bold, futuristic font) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="font-sans">
    <!-- Custom Background Gradient -->
    <div class="bg-gradient absolute inset-0 z-[-1]"></div>

    <!-- Top Bar with Contact Info and Social Media -->
    <div class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white py-2 relative overflow-hidden">
        <!-- Animated Decorative Elements -->
        <div class="absolute top-0 right-0 w-64 h-full bg-primary opacity-10 skew-x-12 hidden md:block md:animate-pulse"></div>
        <div class="absolute top-0 left-1/4 w-32 h-full bg-blue-500 opacity-10 -skew-x-12 hidden md:block"></div>
        <div class="absolute top-0 left-1/2 w-16 h-full bg-green-500 opacity-10 skew-x-12 hidden md:block"></div>
        
        <div class="container mx-auto px-4 sm:px-6 relative z-10">
            <!-- Contact Information and Social Media -->
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <!-- Contact Information -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-2 sm:space-y-0 mb-2 sm:mb-0">
                    <a href="mailto:contact@irisepro.in" class="flex items-center text-sm hover:text-primary transition-colors group">
                        <span class="bg-primary/20 p-1.5 rounded-full mr-2 group-hover:bg-primary/30 transition-all">
                            <i class="fas fa-envelope text-xs"></i>
                        </span>
                        contact@irisepro.in
                    </a>
                    <a href="tel:+918660256342" class="flex items-center text-sm hover:text-primary transition-colors group">
                        <span class="bg-primary/20 p-1.5 rounded-full mr-2 group-hover:bg-primary/30 transition-all">
                            <i class="fas fa-phone text-xs"></i>
                        </span>
                        Call us +91 8660256342
                    </a>
                </div>
                
                <!-- Social Media Links with Enhanced Hover Effects -->
                <!-- <div class="flex space-x-3 mt-2 sm:mt-0">
                    <a href="#" class="w-7 h-7 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary hover:scale-110 transition-all duration-300 group" aria-label="Facebook">
                        <i class="fab fa-facebook-f text-sm group-hover:text-white"></i>
                    </a>
                    <a href="#" class="w-7 h-7 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary hover:scale-110 transition-all duration-300 group" aria-label="Instagram">
                        <i class="fab fa-instagram text-sm group-hover:text-white"></i>
                    </a>
                    <a href="#" class="w-7 h-7 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary hover:scale-110 transition-all duration-300 group" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in text-sm group-hover:text-white"></i>
                    </a>
                    <a href="#" class="w-7 h-7 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary hover:scale-110 transition-all duration-300 group" aria-label="YouTube">
                        <i class="fab fa-youtube text-sm group-hover:text-white"></i>
                    </a>
                </div> -->
            </div>
        </div>
    </div>

    <!-- Header Section with Modern Design -->
    <header class="relative">
        <!-- Logo Section with Enhanced Pattern Background -->
        <section class="relative py-6 bg-white overflow-hidden">
            <!-- Modern Elegant Pattern Background -->
            <div class="absolute inset-0 opacity-[0.05]" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2280%22 height=%2280%22 viewBox=%220 0 80 80%22%3E%3Cg fill=%22%23f58321%22 fill-opacity=%221%22%3E%3Cpath d=%22M0 0h40v40H0V0zm40 40h40v40H40V40zm0-40h2l-2 2V0zm0 4l4-4h2l-6 6V4zm0 4l8-8h2L40 10V8zm0 4L52 0h2L40 14v-2zm0 4L56 0h2L40 18v-2zm0 4L60 0h2L40 22v-2zm0 4L64 0h2L40 26v-2zm0 4L68 0h2L40 30v-2zm0 4L72 0h2L40 34v-2zm0 4L76 0h2L40 38v-2zm0 4L80 0v2L42 40h-2zm4 0L80 4v2L46 40h-2zm4 0L80 8v2L50 40h-2zm4 0l28-28v2L54 40h-2zm4 0l24-24v2L58 40h-2zm4 0l20-20v2L62 40h-2zm4 0l16-16v2L66 40h-2zm4 0l12-12v2L70 40h-2zm4 0l8-8v2l-6 6h-2zm4 0l4-4v2l-2 2h-2z%22/%3E%3C/g%3E%3C/svg%3E'); background-repeat: repeat;"></div>
            
            <!-- Diagonal Gradient Overlay with Animation -->
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 via-transparent to-primary/5"></div>
            
            <!-- Subtle Grid Lines -->
            <div class="absolute inset-0" style="background-image: linear-gradient(to right, rgba(200, 200, 200, 0.05) 1px, transparent 1px), linear-gradient(to bottom, rgba(200, 200, 200, 0.05) 1px, transparent 1px); background-size: 20px 20px;"></div>
            
            <div class="container mx-auto px-4 sm:px-6 flex flex-col items-center relative z-10">
                <div class="flex justify-center">
                    <a href="#" class="transition-transform duration-300 hover:scale-105">
                        <img src="images/irisepro-logo.png" alt="iRisePro Logo" class="h-[100px] sm:h-[110px]">
                    </a>
                </div>
            </div>

        </section>

        <!-- Navigation Section with Sticky Behavior -->
        <section class="top-0 z-50 transition-all duration-300" style="background:#FFD1A8;">
            <div class="container mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
                <!-- Desktop Navigation -->
                <nav class="hidden md:flex space-x-8 lg:space-x-12">
                    <a href="#why-irise" class="font-medium hover:text-primary transition-colors relative group">
                        Why iRiSEPro™
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{route('challenges.all')}}" class="font-medium hover:text-primary transition-colors relative group">
                        Our Courses
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#about" class="font-medium hover:text-primary transition-colors relative group">
                        About iRiSEPro™
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#testimonials" class="font-medium hover:text-primary transition-colors relative group">
                        Testimonials
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#contact" class="font-medium hover:text-primary transition-colors relative group">
                        Contact
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </nav>
                
                <!-- CTA Button (Desktop Only) -->
                <div class="hidden md:block">
                    <a href="#contact" class="bg-primary hover:bg-primary/90 text-white py-2 px-5 rounded-full transition-all duration-300 font-medium text-sm flex items-center space-x-2 hover:shadow-md">
                        <span>Get Started</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
                
                <!-- Mobile Navigation Toggle -->
                <div class="md:hidden flex items-center">
                    <button id="menu-toggle" class="relative flex flex-col justify-center items-center w-12 h-12 rounded-full bg-primary text-white shadow-md hover:bg-primary/90 active:scale-95 transition-all duration-200 focus:outline-none">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </button>
                </div>
            </div>
   
            <!-- Mobile Navigation Menu - Slide Out from Right -->
            <div id="mobile-menu" class="hidden md:hidden fixed top-0 right-0 bottom-0 w-[280px] bg-white py-6 px-6 shadow-lg z-50 border-l border-gray-100 opacity-0 transform translate-x-full transition-all duration-300 overflow-y-auto">
                <!-- Close Button -->
                <div class="flex justify-end mb-6">
                    <button id="close-menu" class="text-gray-500 hover:text-primary p-2 rounded-full hover:bg-gray-100 transition-all">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <!-- Menu Logo -->
                <div class="flex justify-center mb-8">
                    <img src="images/irisepro-logo.png" alt="iRisePro Logo" class="h-[60px]">
                </div>
                
                <div class="flex flex-col space-y-4">
                    <a href="#why-irise" class="font-medium hover:text-primary transition-colors py-3 border-b border-gray-100 flex items-center">
                        <i class="fas fa-info-circle mr-3 text-primary/80"></i>Why iRiSEPro™
                    </a>
                    <a href="{{route('challenges.all')}}" class="font-medium hover:text-primary transition-colors py-3 border-b border-gray-100 flex items-center">
                        <i class="fas fa-graduation-cap mr-3 text-primary/80"></i>Programs
                    </a>
                    <a href="#about" class="font-medium hover:text-primary transition-colors py-3 border-b border-gray-100 flex items-center">
                        <i class="fas fa-star mr-3 text-primary/80"></i>Features
                    </a>
                    <a href="#testimonials" class="font-medium hover:text-primary transition-colors py-3 border-b border-gray-100 flex items-center">
                        <i class="fas fa-quote-right mr-3 text-primary/80"></i>Testimonials
                    </a>
                    <a href="#contact" class="font-medium hover:text-primary transition-colors py-3 border-b border-gray-100 flex items-center">
                        <i class="fas fa-envelope mr-3 text-primary/80"></i>Contact
                    </a>
                    <!-- Mobile CTA Button -->
                    <a href="#contact" class="bg-primary hover:bg-primary/90 text-white py-3 px-5 rounded-full transition-all duration-300 font-medium text-center mt-4 flex items-center justify-center space-x-2">
                        <span>Get Started</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
            
            <!-- Overlay for Mobile Menu -->
            <div id="mobile-menu-overlay" class="hidden md:hidden fixed inset-0 bg-black/50 z-40 opacity-0 transition-opacity duration-300"></div>
        </section>
    </header>
