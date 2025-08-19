
    @include('landing.partials.header')

    <!-- Introduction Section -->
    <section class="py-20">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">

                <div class="md:w-1/3">
                    <img src="images/Home-page-picture.png" alt="Career Acceleration" class="rounded-lg shadow-2xl w-full">
                </div>
                <div class="md:w-2/3 mb-12 md:mb-0 pr-0 md:pr-12" style="padding: 30px;">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">
                        Inspired by the <span class="text-primary">Trimoortis,</span> <br>We’re Here to Empower You!
                    </h2>
                    <p class="text-lg mb-4 text-gray-700">
                        At iRiSEPro™, we believe in transformation. Our mission is simple yet powerful:
                    </p>
                       
                    <div class="my-4">
                        <span class="text-2xl md:text-3xl font-bold py-2 px-4 bg-gradient-to-r from-primary to-orange-400 text-white rounded-lg shadow-lg inline-block transform hover:scale-105 transition-transform duration-300">✨ YOU RISE = INDIA RISE ✨</span>
                    </div>
                    
                    <p class="text-lg mb-8 text-gray-700">
                        Through the iRiSEPro™ Copyrighted and Trademarked Revolutionary Student Tangible Transformative & Employment Enhancement Program (STEP), we're here to redefine education, self-discovery, and career success in a way that truly matters.
                        <br><br>
                        🚀 Ready to take the first step toward a brighter future? Let's do this together!
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#courses" class="btn-primary">
                            Explore Programs
                        </a>
                        <a href="#contact" class="btn-secondary">
                            Contact Us
                        </a>
                    </div>
                </div>
              
            </div>
        </div>
    </section>
    
    <!-- Modern Brag Counter Section -->
    <section class="py-20 bg-gradient-to-b from-white to-gray-50 relative overflow-hidden">

         <!-- Modern Elegant Pattern Background -->
         <div class="absolute inset-0 opacity-[0.05]" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2280%22 height=%2280%22 viewBox=%220 0 80 80%22%3E%3Cg fill=%22%23f58321%22 fill-opacity=%221%22%3E%3Cpath d=%22M0 0h40v40H0V0zm40 40h40v40H40V40zm0-40h2l-2 2V0zm0 4l4-4h2l-6 6V4zm0 4l8-8h2L40 10V8zm0 4L52 0h2L40 14v-2zm0 4L56 0h2L40 18v-2zm0 4L60 0h2L40 22v-2zm0 4L64 0h2L40 26v-2zm0 4L68 0h2L40 30v-2zm0 4L72 0h2L40 34v-2zm0 4L76 0h2L40 38v-2zm0 4L80 0v2L42 40h-2zm4 0L80 4v2L46 40h-2zm4 0L80 8v2L50 40h-2zm4 0l28-28v2L54 40h-2zm4 0l24-24v2L58 40h-2zm4 0l20-20v2L62 40h-2zm4 0l16-16v2L66 40h-2zm4 0l12-12v2L70 40h-2zm4 0l8-8v2l-6 6h-2zm4 0l4-4v2l-2 2h-2z%22/%3E%3C/g%3E%3C/svg%3E'); background-repeat: repeat;"></div>
            
         <!-- Diagonal Gradient Overlay with Animation -->
         <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 via-transparent to-primary/5"></div>
         
         <!-- Subtle Grid Lines -->
         <div class="absolute inset-0" style="background-image: linear-gradient(to right, rgba(200, 200, 200, 0.05) 1px, transparent 1px), linear-gradient(to bottom, rgba(200, 200, 200, 0.05) 1px, transparent 1px); background-size: 20px 20px;"></div>

        <!-- SVG Background Pattern -->
        <div class="absolute inset-0 z-0 opacity-10">
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 0 10 L 40 10 M 10 0 L 10 40 M 0 20 L 40 20 M 20 0 L 20 40 M 0 30 L 40 30 M 30 0 L 30 40" fill="none" stroke="#F58321" stroke-width="0.5"/>
                    </pattern>
                    <pattern id="circles" width="60" height="60" patternUnits="userSpaceOnUse">
                        <circle cx="10" cy="10" r="2" fill="#F58321" opacity="0.5"/>
                        <circle cx="30" cy="30" r="2" fill="#F58321" opacity="0.5"/>
                        <circle cx="50" cy="10" r="2" fill="#F58321" opacity="0.5"/>
                    </pattern>
                    <pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse" patternTransform="rotate(45)">
                        <circle cx="3" cy="3" r="1" fill="#F58321" opacity="0.4"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#dots)"/>
                <rect width="100%" height="100%" fill="url(#grid)" opacity="0.3"/>
                <rect width="100%" height="100%" fill="url(#circles)" opacity="0.2"/>
            </svg>
        </div>
        
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 rounded-full bg-primary opacity-5 -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 rounded-full bg-orange-400 opacity-5 translate-y-1/2 -translate-x-1/2"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    Our <span class="text-primary">Impact</span> in Numbers
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Transforming education and careers across India since 2015</p>
            </div>
            
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Years Counter -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-bold text-gray-800">Years of Excellence</h3>
                            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center">
                                <i class="fas fa-history text-primary text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 text-center">
                        <div class="text-6xl font-bold text-primary mb-2 counter" data-target="10">0</div>
                        <p class="text-gray-600 mt-2">Since our founding in 2015, we've been committed to bridging the gap between education and industry, creating pathways for success.</p>
                    </div>
                </div>
                
                <!-- Brainstorms Counter -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-bold text-gray-800">Innovative Sessions</h3>
                            <div class="w-12 h-12 rounded-full bg-orange-400/10 flex items-center justify-center">
                                <i class="fas fa-lightbulb text-orange-400 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 text-center">
                        <div class="text-6xl font-bold text-orange-500 mb-2 counter" data-target="1000">0</div>
                        <p class="text-gray-600 mt-2">Our think tanks and innovation labs have generated thousands of ideas, methodologies, and frameworks that revolutionize education.</p>
                    </div>
                </div>
                
                <!-- Lives Counter -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-bold text-gray-800">Lives Transformed</h3>
                            <div class="w-12 h-12 rounded-full bg-yellow-400/10 flex items-center justify-center">
                                <i class="fas fa-users text-yellow-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 text-center">
                        <div class="text-6xl font-bold text-yellow-500 mb-2 counter" data-target="5000">0</div>
                        <p class="text-gray-600 mt-2">Each number represents a student, professional, or entrepreneur whose life trajectory was forever changed through our programs.</p>
                    </div>
                </div>
            </div>
            
            <!-- Vision Statement -->
            <div class="bg-white rounded-lg shadow-md p-6 max-w-3xl mx-auto border-l-4 border-primary">
                <div class="flex items-start">
                    <div class="mr-4 mt-1">
                        <span class="text-primary text-xl">“</span>
                    </div>
                    <div>
                        <p class="text-lg italic mb-3 text-gray-700">
                            After a decade of collaboration with academicians, psychologists, sociologists, scientists, educationists, institution owners, and teachers, iRiSEPro has created something truly groundbreaking—a one-of-a-kind Educo-Socio-Psycho Program  designed to make self-discovery journey experiential, engaging, and exciting.
                        </p>
                        <div class="flex items-center">
                            <span class="text-sm font-medium text-gray-600">iRiSEPro™ Founding Vision</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Why iRiSEPro Stands Apart Section -->
    <section id="why-irise"class="py-20 bg-gray-900 relative overflow-hidden" style="background-attachment: fixed; background-position: center; background-size: cover; background-image: url('images/parallax-bg-2.jpg');">        
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-24 h-24 rounded-full bg-primary/10 animate-float-slow hidden md:block"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 rounded-full bg-primary/5 animate-float-medium hidden md:block"></div>
        <div class="absolute top-1/2 right-1/4 w-16 h-16 rounded-full bg-primary/10 animate-float-fast hidden lg:block"></div>
        <div class="absolute bottom-1/3 left-1/4 w-20 h-20 rounded-full bg-primary/5 animate-float-reverse hidden lg:block"></div>
        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 opacity-5">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <pattern id="hexagons" width="50" height="43.4" patternUnits="userSpaceOnUse" patternTransform="scale(2)">
                    <polygon points="25,0 50,14.4 50,28.8 25,43.4 0,28.8 0,14.4" fill="none" stroke="#F58321" stroke-width="0.5"/>
                </pattern>
                <rect width="100%" height="100%" fill="url(#hexagons)" />
            </svg>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-white">
                    Why <span class="text-primary">iRiSEPro™</span> Stands Apart?
                </h2>
                <p class="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto">
                    Unlike any program before it, iRiSEPro is not just a program—it's a 
                    <span class="font-bold text-primary">Holistic Self-Discovery & Transformative Revolution!</span>
                </p>
            </div>
            
            <!-- Feature Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Card 1 -->
                <div class="bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group border border-gray-700 hover:border-primary/50 animate-fadeIn" style="animation-delay: calc(1 * 150ms);">
                    <div class="p-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary/30 to-primary/10 rounded-full flex items-center justify-center mb-4 shadow-md border border-primary/30 transform transition-transform duration-300 group-hover:scale-110 group-hover:border-primary/50">
                            <i class="fas fa-clock text-primary text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-white">Time Efficient</h3>
                        <p class="text-gray-300">Just 15 minutes a day at home and for just 30 days.</p>
                    </div>
                </div>
                
                <!-- Card 2 -->
                <div class="bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group border border-gray-700 hover:border-primary/50 animate-fadeIn" style="animation-delay: calc(2 * 150ms);">
                    <div class="p-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary/30 to-primary/10 rounded-full flex items-center justify-center mb-4 shadow-md border border-primary/30 transform transition-transform duration-300 group-hover:scale-110 group-hover:border-primary/50">
                            <i class="fas fa-wallet text-primary text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-white">Affordable</h3>
                        <p class="text-gray-300">Incredibly affordable fee.</p>
                    </div>
                </div>
                
                <!-- Card 3 -->
                <div class="bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group border border-gray-700 hover:border-primary/50 animate-fadeIn" style="animation-delay: calc(3 * 150ms);">
                    <div class="p-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary/30 to-primary/10 rounded-full flex items-center justify-center mb-4 shadow-md border border-primary/30 transform transition-transform duration-300 group-hover:scale-110 group-hover:border-primary/50">
                            <i class="fas fa-brain text-primary text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-white">Scientific Approach</h3>
                        <p class="text-gray-300">Scientifically developed Tasks-centric, 7-step holistic self-discovery process.</p>
                    </div>
                </div>
                
                <!-- Card 4 -->
                <div class="bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group border border-gray-700 hover:border-primary/50 animate-fadeIn" style="animation-delay: calc(4 * 150ms);">
                    <div class="p-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary/30 to-primary/10 rounded-full flex items-center justify-center mb-4 shadow-md border border-primary/30 transform transition-transform duration-300 group-hover:scale-110 group-hover:border-primary/50">
                            <i class="fas fa-user-edit text-primary text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-white">Personalized</h3>
                        <p class="text-gray-300">Personalized attention & customization for every participant.</p>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 5 -->
                <div class="bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group border border-gray-700 hover:border-primary/50 animate-fadeIn" style="animation-delay: calc(5 * 150ms);">
                    <div class="p-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary/30 to-primary/10 rounded-full flex items-center justify-center mb-4 shadow-md border border-primary/30 transform transition-transform duration-300 group-hover:scale-110 group-hover:border-primary/50">
                            <i class="fas fa-hands-helping text-primary text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-white">Dedicated Guidance</h3>
                        <p class="text-gray-300">Dedicated YASHODARSHI guides learners at every step.</p>
                    </div>
                </div>
                
                <!-- Card 6 -->
                <div class="bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group border border-gray-700 hover:border-primary/50 animate-fadeIn" style="animation-delay: calc(6 * 150ms);">
                    <div class="p-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary/30 to-primary/10 rounded-full flex items-center justify-center mb-4 shadow-md border border-primary/30 transform transition-transform duration-300 group-hover:scale-110 group-hover:border-primary/50">
                            <i class="fas fa-chart-line text-primary text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-white">AACE64 Framework</h3>
                        <p class="text-gray-300">Unique AACE64 Framework assessing critical pillars of human potential.</p>
                    </div>
                </div>
                
                <!-- Card 7 -->
                <div class="bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group border border-gray-700 hover:border-primary/50 animate-fadeIn" style="animation-delay: calc(7 * 150ms);">
                    <div class="p-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary/30 to-primary/10 rounded-full flex items-center justify-center mb-4 shadow-md border border-primary/30 transform transition-transform duration-300 group-hover:scale-110 group-hover:border-primary/50">
                            <i class="fas fa-road text-primary text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-white">Growth Roadmap</h3>
                        <p class="text-gray-300">A roadmap for growth through curated insights and recommendations.</p>
                    </div>
                </div>
            </div>
            
            <!-- Call to Action -->
            <div class="mt-16 text-center">
                <a href="#" id="open-modal-btn" class="inline-block bg-primary hover:bg-orange-600 text-white font-bold px-8 py-4 rounded-lg shadow-lg transition-all transform hover:-translate-y-1 border border-primary/50 hover:border-primary glow-on-hover">
                    Begin Your Transformation
                </a>
            </div>
        </div>
    </section>

    <!-- What Will You Gain Section -->
    <section class="py-20 bg-white relative overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 opacity-5">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="2" fill="#F58321" />
                </pattern>
                <rect width="100%" height="100%" fill="url(#dots)" />
            </svg>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-800">
                    What <span class="text-primary">Will You</span> Gain?
                </h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
                    By the end of the program, depending on your chosen course, you will receive:
                </p>
            </div>
            
            <!-- Two Column Layout -->
            <div class="flex flex-col lg:flex-row gap-10 items-center">
                <!-- Left Column - Student Image -->
                <div class="w-full lg:w-1/2 animate-fadeIn" style="animation-delay: 300ms;">
                    <div class="relative">
                        <div class="absolute -top-6 -left-6 w-32 h-32 bg-primary/10 rounded-full animate-float-slow"></div>
                        <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-primary/20 rounded-full animate-float-medium"></div>
                        <div class="rounded-xl shadow-xl w-full h-[500px] border border-gray-200 relative z-10 bg-gradient-to-br from-gray-100 to-gray-200 flex flex-col items-center justify-center overflow-hidden">
                            <img src="images/hero-picture-2.png" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
                
                <!-- Right Column - Benefits List -->
                <div class="w-full lg:w-1/2 animate-fadeIn" style="animation-delay: 500ms;">
                    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-xl p-8 border border-gray-200">
                        <ul class="space-y-4">
                            <li class="flex items-start space-x-3 animate-fadeIn transform transition-all duration-300 hover:translate-x-1 hover:text-primary/90" style="animation-delay: 600ms;">
                                <span class="text-primary text-xl">🔹</span>
                                <span class="text-gray-700">A self-discovered, empowered YOU—Your Version 2.0!</span>
                            </li>
                            <li class="flex items-start space-x-3 animate-fadeIn transform transition-all duration-300 hover:translate-x-1 hover:text-primary/90" style="animation-delay: 700ms;">
                                <span class="text-primary text-xl">🔹</span>
                                <span class="text-gray-700">A comprehensive report based on the exclusive, copyrighted AACE64 FRAMEWORK</span>
                            </li>
                            <li class="flex items-start space-x-3 animate-fadeIn transform transition-all duration-300 hover:translate-x-1 hover:text-primary/90" style="animation-delay: 800ms;">
                                <span class="text-primary text-xl">🔹</span>
                                <span class="text-gray-700">Measurable and Tangible Assessment of your strengths & growth areas across Attitude, Aptitude, Communication & Execution and 64 imperative abilities for success</span>
                            </li>
                            <li class="flex items-start space-x-3 animate-fadeIn transform transition-all duration-300 hover:translate-x-1 hover:text-primary/90" style="animation-delay: 900ms;">
                                <span class="text-primary text-xl">🔹</span>
                                <span class="text-gray-700">Tailored guidance on suitable higher studies</span>
                            </li>
                            <li class="flex items-start space-x-3 animate-fadeIn transform transition-all duration-300 hover:translate-x-1 hover:text-primary/90" style="animation-delay: 1000ms;">
                                <span class="text-primary text-xl">🔹</span>
                                <span class="text-gray-700">Tailored guidance on suitable career opportunities</span>
                            </li>
                            <li class="flex items-start space-x-3 animate-fadeIn transform transition-all duration-300 hover:translate-x-1 hover:text-primary/90" style="animation-delay: 1100ms;">
                                <span class="text-primary text-xl">🔹</span>
                                <span class="text-gray-700">A personalized FOCUS AREAS TO PROGRESS report</span>
                            </li>
                        </ul>
                        
                        <!-- Mini CTA -->
                        <div class="mt-8 text-center">
                            <a href="#" id="explore-modal-btn" class="inline-block px-6 py-3 bg-primary text-white font-medium rounded-lg shadow-md hover:bg-orange-600 transition-all duration-300 transform hover:-translate-y-1">Explore Our Programs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


      <!-- Course Offerings Section with Image-Based Cards -->
      <section id="courses" class="py-16 bg-gray-50 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-primary/5 rounded-full -translate-x-1/2 -translate-y-1/2 animate-float-slow"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-500/5 rounded-full translate-x-1/3 translate-y-1/3 animate-float-medium"></div>
        <div class="absolute top-1/2 left-1/4 w-32 h-32 bg-green-500/5 rounded-full animate-float-fast"></div>
        
        <div class="container mx-auto px-4 sm:px-6 relative z-10">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Our <span class="text-primary">Course Offerings</span></h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Transform yourself. Unlock your potential. Rise with iRiSEPro!</p>
            </div>
            
            @if($upcomingChallenges->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    @foreach($upcomingChallenges as $challenge)
                        @php
                            $nextBatch = $challenge->batches->first();
                            $colors = ['primary', 'blue-500', 'green-500', 'purple-500', 'indigo-500', 'pink-500'];
                            $color = $colors[$loop->index % count($colors)];
                            $colorClass = $color === 'primary' ? 'primary' : $color;
                        @endphp
                        
                   
                        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                            <!-- Image at the top -->
                            <div class="relative h-48 overflow-hidden">
                                <!-- Background Image -->
                                @if($challenge->thumbnail_image )
                                    <img src="{{ asset($challenge->thumbnail_image) }}" 
                                         alt="{{ $challenge->title }}" 
                                         class="absolute inset-0 w-full h-full object-cover">
                                @else
                                    <div class="absolute inset-0 bg-gradient-to-br from-{{ $colorClass }}/20 to-{{ $colorClass }}/40 flex items-center justify-center">
                                        <i class="fas fa-graduation-cap text-6xl text-{{ $colorClass }} opacity-50"></i>
                                    </div>
                                @endif
                                
                                <!-- Floating Badge with Start Date -->
                                @if($nextBatch)
                                    <div class="absolute top-4 right-4 bg-white text-{{ $colorClass }} font-bold py-1 px-3 rounded-full shadow-sm">
                                        Starts {{ \Carbon\Carbon::parse($nextBatch->start_date)->format('M d') }}
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Content at the bottom -->
                            <div class="p-5">
                                <!-- Course Title -->
                                <div class="text-center mb-4">
                                    <h3 class="text-gray-800 text-xl font-bold">{{ $challenge->title }}</h3>
                                    <p class="text-{{ $colorClass }} text-sm">{{ Str::limit($challenge->description, 50) }}</p>
                                </div>
                                
                                <!-- Feature list with simplified styling -->
                                @if($nextBatch)
                                    <div class="flex items-center mb-4">
                                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-{{ $colorClass }}/10 flex items-center justify-center mr-3">
                                            <span class="text-{{ $colorClass }} text-2xl"><i class="far fa-calendar"></i></span>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-800">Start Date</h3>
                                            <p class="text-gray-600 text-sm">{{ \Carbon\Carbon::parse($nextBatch->start_date)->format('F d, Y') }}</p>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="flex items-center mb-4">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-full bg-{{ $colorClass }}/10 flex items-center justify-center mr-3">
                                        <span class="text-{{ $colorClass }} text-2xl"><i class="fas fa-rupee-sign"></i></span>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-800">Price</h3>
                                        <p class="text-gray-600 text-sm">
                                            @if($challenge->special_price)
                                                <span class="line-through text-gray-400">₹{{ number_format($challenge->selling_price, 0) }}</span>
                                                <span class="text-green-600 font-bold">₹{{ number_format($challenge->special_price, 0) }}</span>
                                            @else
                                                ₹{{ number_format($challenge->selling_price, 0) }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center mb-4">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-full bg-{{ $colorClass }}/10 flex items-center justify-center mr-3">
                                        <span class="text-{{ $colorClass }} text-2xl"><i class="fas fa-tasks"></i></span>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-800">Tasks</h3>
                                        <p class="text-gray-600 text-sm">{{ $challenge->number_of_tasks }} engaging activities</p>
                                    </div>
                                </div>
                                
                                <div class="mt-6">
                                    <a href="{{ route('challenge.details', $challenge->id) }}" class="btn-primary w-full block text-center">
                                        Enroll Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Fallback content when no challenges are available -->
                <div class="text-center py-12">
                    <div class="bg-white rounded-lg shadow-lg p-8 max-w-md mx-auto">
                        <i class="fas fa-calendar-times text-6xl text-gray-400 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">No Upcoming Challenges</h3>
                        <p class="text-gray-600 mb-4">We're preparing exciting new challenges for you. Check back soon!</p>
                        <a href="#contact" class="btn-primary inline-block">
                            Get Notified
                        </a>
                    </div>
                </div>
            @endif


  
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-10">Other Programs</h2>
            <div class="flex flex-wrap justify-center gap-12 md:gap-20">
                <!-- Program 1 -->
                <div class="w-48 text-center transform transition-all duration-300 hover:translate-y-[-5px]">
                    <div class="bg-white rounded-xl shadow-lg p-4 mb-3 flex items-center justify-center overflow-hidden" style="aspect-ratio: 16/9;">
                        <!-- Nurtura image -->
                        <img src="images/nurtura.png" alt="Nurtura Program" class="w-full h-full object-contain">
                    </div>
                    <h3 class="font-bold text-gray-800 mt-3">Nurtura</h3>
                </div>
                
                <!-- Program 2 -->
                <div class="w-48 text-center transform transition-all duration-300 hover:translate-y-[-5px]">
                    <div class="bg-white rounded-xl shadow-lg p-4 mb-3 flex items-center justify-center overflow-hidden" style="aspect-ratio: 16/9;">
                        <!-- Transcender image -->
                        <img src="images/transcender.png" alt="Transcender Program" class="w-full h-full object-contain">
                    </div>
                    <h3 class="font-bold text-gray-800 mt-3">Transcender</h3>
                </div>
                
                <!-- Program 3 -->
                <div class="w-48 text-center transform transition-all duration-300 hover:translate-y-[-5px]">
                    <div class="bg-white rounded-xl shadow-lg p-4 mb-3 flex items-center justify-center overflow-hidden" style="aspect-ratio: 16/9;">
                        <!-- CorpPro image -->
                        <img src="images/corppro.png" alt="CorpPro Program" class="w-full h-full object-contain">
                    </div>
                    <h3 class="font-bold text-gray-800 mt-3">CorpPro</h3>
                </div>
            </div>
        </div>

            
            
            <!-- Additional Information with Enhanced Design -->
            <!-- Two-Column Layout for Important Information and Partnership Opportunity -->
            <div class="mt-12 container mx-auto px-4">
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Important Information - Left Column -->
                    <div class="w-full md:w-1/2 bg-white rounded-xl p-8 shadow-lg">
                        <h3 class="text-xl font-bold mb-6 text-center">Important Information</h3>
                        <div class="space-y-5">
                            <div class="flex items-start transform hover:translate-x-1 transition-transform duration-300">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center mr-4">
                                    <span class="text-primary text-xl"><i class="fas fa-rocket"></i></span>
                                </div>
                                <p class="text-gray-700 font-medium">Limited Seats—Secure Yours. Sign Up Now!</p>
                            </div>
                            
                            <div class="flex items-start transform hover:translate-x-1 transition-transform duration-300">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center mr-4">
                                    <span class="text-primary text-xl"><i class="fas fa-calendar-check"></i></span>
                                </div>
                                <p class="text-gray-700 font-medium">Starting July 15, iRiSEPro welcomes students across India!</p>
                            </div>
                            
                            <div class="flex items-start transform hover:translate-x-1 transition-transform duration-300">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center mr-4">
                                    <span class="text-primary text-xl"><i class="fas fa-users"></i></span>
                                </div>
                                <p class="text-gray-700 font-medium">Our MargaDarshi team will begin reaching out from July 10—Stay tuned!</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Partnership Opportunity - Right Column -->
                    <div class="w-full md:w-1/2 bg-white rounded-xl p-8 shadow-lg">
                        <div class="mb-6 bg-gradient-to-r from-primary to-orange-500 text-white px-6 py-3 rounded-xl font-bold text-lg shadow-lg inline-block">
                            🌟 Partnership Opportunity 🌟
                        </div>
                        <p class="text-gray-700 leading-relaxed mb-6">
                            iRiSEPro is now open for direct tie-ups with educational institutions, offering a multi-benefit package designed to elevate learning experiences, empower students, guide parents and enhance institutional excellence.
                        </p>
                        <div class="mt-4">
                            <a href="#contact" class="btn-secondary inline-flex items-center px-6 py-2 rounded-lg group hover:shadow-lg transition-all duration-300">
                                <span>Partner With Us</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transform group-hover:translate-x-1 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


   <!-- Founder, Vision & Mission Section -->
    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Founder, Vision & Mission</h2>
                <div class="w-24 h-1 bg-primary mx-auto"></div>
            </div>
            
            <!-- Founder Section -->
            <div class="flex flex-col md:flex-row items-center mb-20">
                <div class="md:w-1/3 mb-12 md:mb-0">
                    <div class="relative">
                        <div class="absolute inset-0 bg-primary/20 rounded-full transform -rotate-6"></div>
                        <img src="images/Krishnaraja-Manjunatha.webp" alt="Krishnaraja M Manjunath" class="rounded-lg shadow-xl w-full relative z-10">
                    </div>
                </div>
                <div class="md:w-2/3 md:pl-16">
                    <div class="flex items-center mb-4">
                        <div class="mr-4 text-primary text-3xl"><i class="fas fa-user-tie"></i></div>
                        <h3 class="text-2xl font-bold">Our Founder</h3>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Krishnaraja M Manjunath</h4>
                    <p class="text-primary font-medium mb-4">Founder & CEO, iRiSEPro</p>
                    <p class="text-gray-600 italic mb-6">(Former Chief, ETV Network | Ex-Karnataka Civil Services Officer | Closely worked with two Chief Ministers of Karnataka)</p>
                    
                    <p class="text-gray-700 mb-4">
                        Born from the spiritual legacy of Sri Ramakrishna Vidyashala, Mysore and shaped by real-world leadership, Krishnaraja M Manjunath transitioned from a stellar media and civil services career to dedicate his life to India's transformation.
                    </p>
                    <p class="text-gray-700 mb-4">
                        He left a high-profile civil service career to pursue one mission:
                    </p>
                 
                    <div class="my-4">
                        <span class="text-2xl md:text-3xl font-bold py-2 px-4 bg-gradient-to-r from-primary to-orange-400 text-white rounded-lg shadow-lg inline-block transform hover:scale-105 transition-transform duration-300">✨ Supreme India, Happy Indians. ✨</span>
                    </div>
                    <p class="text-gray-700">
                        For over a decade, he built iRiSEPro — a movement to create a generation of economically prosperous, emotionally grounded, spiritually awakened, and nationally committed Indians.
                    </p>
                </div>
            </div>
            
            <!-- Vision & Mission -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mt-16">
                <!-- Vision -->
                <div class="bg-gradient-to-br from-white to-orange-50 rounded-xl p-8 shadow-xl transform transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl relative overflow-hidden group">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 group-hover:bg-primary/10 transition-all duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-primary/5 rounded-full -ml-12 -mb-12 group-hover:bg-primary/10 transition-all duration-500"></div>
                    
                    <div class="relative z-10">
                        <div class="flex flex-col items-center mb-8">
                            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-primary to-orange-400 flex items-center justify-center mb-4 shadow-lg transform transition-transform duration-300 group-hover:scale-110">
                                <span class="text-white text-3xl"><i class="fas fa-eye"></i></span>
                            </div>
                            <h3 class="text-2xl font-bold bg-gradient-to-r from-primary to-orange-600 bg-clip-text text-transparent">Our Vision</h3>
                        </div>
                        <div class="text-center">
                            <p class="text-gray-700 leading-relaxed text-lg">
                                To revolutionize the human development ecosystem across India through experiential learning rooted in research.
                            </p>
                            <div class="mt-6 w-16 h-1 bg-primary mx-auto opacity-50 group-hover:w-32 transition-all duration-500"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Mission -->
                <div class="bg-gradient-to-br from-white to-orange-50 rounded-xl p-8 shadow-xl transform transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl relative overflow-hidden group">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 group-hover:bg-primary/10 transition-all duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-primary/5 rounded-full -ml-12 -mb-12 group-hover:bg-primary/10 transition-all duration-500"></div>
                    
                    <div class="relative z-10">
                        <div class="flex flex-col items-center mb-8">
                            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-primary to-orange-400 flex items-center justify-center mb-4 shadow-lg transform transition-transform duration-300 group-hover:scale-110">
                                <span class="text-white text-3xl"><i class="fas fa-flag"></i></span>
                            </div>
                            <h3 class="text-2xl font-bold bg-gradient-to-r from-primary to-orange-600 bg-clip-text text-transparent">Our Mission</h3>
                        </div>
                        <div class="text-center">
                            <p class="text-gray-700 leading-relaxed text-lg">
                                To empower every Indian to rise in their personal potential and contribute meaningfully toward making India the Supreme Power.
                            </p>
                            <div class="mt-6 w-16 h-1 bg-primary mx-auto opacity-50 group-hover:w-32 transition-all duration-500"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Testimonials Section with Carousel -->  
    <section id="testimonials" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Success Stories</h2>
                <div class="w-24 h-1 bg-primary mx-auto mb-6"></div>
                <p class="text-gray-700 max-w-3xl mx-auto">
                    Hear from our students and parents who have experienced the iRiSEPro difference.
                </p>
            </div>
            
            <!-- Carousel Container -->
            <div class="relative testimonial-carousel">
                <!-- Carousel Slides -->
                <div class="carousel-slides overflow-hidden">
                    <!-- Slide 1 (First 3 testimonials) -->
                    <div class="carousel-slide grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Student Testimonial 1 -->
                        <div class="bg-gradient-to-br from-white to-orange-50 p-6 rounded-xl shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl relative overflow-hidden group">
                            <!-- Decorative elements -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 group-hover:bg-primary/10 transition-all duration-500"></div>
                            <div class="absolute bottom-0 left-0 w-16 h-16 bg-primary/5 rounded-full -ml-8 -mb-8 group-hover:bg-primary/10 transition-all duration-500"></div>
                            
                            <div class="relative z-10">
                                <div class="flex items-center mb-6">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-gradient-to-br from-primary to-orange-400 rounded-full opacity-20 animate-pulse-slow"></div>
                                        <img src="https://placehold.co/100x100/F58321/FFFFFF/png?text=A" alt="Avatar" class="w-16 h-16 rounded-full border-2 border-primary relative z-10 shadow-md">
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="font-bold text-gray-800 text-lg">Arjun Sharma</h4>
                                        <p class="text-primary text-sm font-medium">Engineering Student, Delhi</p>
                                    </div>
                                </div>
                                <div class="pl-2">
                                    <span class="text-primary text-3xl absolute opacity-20"><i class="fas fa-quote-left"></i></span>
                                    <p class="text-gray-700 italic pl-6 relative z-10">
                                        "iRiSEPro's scientific approach transformed my career outlook. The personalized attention and structured guidance helped me secure an internship at my dream company within weeks."
                                    </p>
                                </div>
                                <div class="w-16 h-1 bg-primary mx-auto mt-6 opacity-50 group-hover:w-32 transition-all duration-500"></div>
                            </div>
                        </div>
                        
                        <!-- Parent Testimonial 1 -->
                        <div class="bg-gradient-to-br from-white to-orange-50 p-6 rounded-xl shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl relative overflow-hidden group">
                            <!-- Decorative elements -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 group-hover:bg-primary/10 transition-all duration-500"></div>
                            <div class="absolute bottom-0 left-0 w-16 h-16 bg-primary/5 rounded-full -ml-8 -mb-8 group-hover:bg-primary/10 transition-all duration-500"></div>
                            
                            <div class="relative z-10">
                                <div class="flex items-center mb-6">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-gradient-to-br from-primary to-orange-400 rounded-full opacity-20 animate-pulse-slow"></div>
                                        <img src="https://placehold.co/100x100/F58321/FFFFFF/png?text=R" alt="Avatar" class="w-16 h-16 rounded-full border-2 border-primary relative z-10 shadow-md">
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="font-bold text-gray-800 text-lg">Rajesh Gupta</h4>
                                        <p class="text-primary text-sm font-medium">Parent, Mumbai</p>
                                    </div>
                                </div>
                                <div class="pl-2">
                                    <span class="text-primary text-3xl absolute opacity-20"><i class="fas fa-quote-left"></i></span>
                                    <p class="text-gray-700 italic pl-6 relative z-10">
                                        "As a parent, I was concerned about my daughter's career direction. iRiSEPro's YASHODARSHI guidance gave her clarity and confidence. The affordable fee made it accessible for us."
                                    </p>
                                </div>
                                <div class="w-16 h-1 bg-primary mx-auto mt-6 opacity-50 group-hover:w-32 transition-all duration-500"></div>
                            </div>
                        </div>
                        
                        <!-- Student Testimonial 2 -->
                        <div class="bg-gradient-to-br from-white to-orange-50 p-6 rounded-xl shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl relative overflow-hidden group">
                            <!-- Decorative elements -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 group-hover:bg-primary/10 transition-all duration-500"></div>
                            <div class="absolute bottom-0 left-0 w-16 h-16 bg-primary/5 rounded-full -ml-8 -mb-8 group-hover:bg-primary/10 transition-all duration-500"></div>
                            
                            <div class="relative z-10">
                                <div class="flex items-center mb-6">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-gradient-to-br from-primary to-orange-400 rounded-full opacity-20 animate-pulse-slow"></div>
                                        <img src="https://placehold.co/100x100/F58321/FFFFFF/png?text=P" alt="Avatar" class="w-16 h-16 rounded-full border-2 border-primary relative z-10 shadow-md">
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="font-bold text-gray-800 text-lg">Priya Patel</h4>
                                        <p class="text-primary text-sm font-medium">Commerce Graduate, Bangalore</p>
                                    </div>
                                </div>
                                <div class="pl-2">
                                    <span class="text-primary text-3xl absolute opacity-20"><i class="fas fa-quote-left"></i></span>
                                    <p class="text-gray-700 italic pl-6 relative z-10">
                                        "The AACE64 Framework helped me identify my strengths and work on my weaknesses. Just 15 minutes daily for a month completely changed my professional outlook."
                                    </p>
                                </div>
                                <div class="w-16 h-1 bg-primary mx-auto mt-6 opacity-50 group-hover:w-32 transition-all duration-500"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Slide 2 (Next 3 testimonials) -->
                    <div class="carousel-slide grid grid-cols-1 md:grid-cols-3 gap-8 hidden">
                        <!-- Parent Testimonial 2 -->
                        <div class="bg-gradient-to-br from-white to-orange-50 p-6 rounded-xl shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl relative overflow-hidden group">
                            <!-- Decorative elements -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 group-hover:bg-primary/10 transition-all duration-500"></div>
                            <div class="absolute bottom-0 left-0 w-16 h-16 bg-primary/5 rounded-full -ml-8 -mb-8 group-hover:bg-primary/10 transition-all duration-500"></div>
                            
                            <div class="relative z-10">
                                <div class="flex items-center mb-6">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-gradient-to-br from-primary to-orange-400 rounded-full opacity-20 animate-pulse-slow"></div>
                                        <img src="https://placehold.co/100x100/F58321/FFFFFF/png?text=S" alt="Avatar" class="w-16 h-16 rounded-full border-2 border-primary relative z-10 shadow-md">
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="font-bold text-gray-800 text-lg">Sunita Reddy</h4>
                                        <p class="text-primary text-sm font-medium">Parent, Hyderabad</p>
                                    </div>
                                </div>
                                <div class="pl-2">
                                    <span class="text-primary text-3xl absolute opacity-20"><i class="fas fa-quote-left"></i></span>
                                    <p class="text-gray-700 italic pl-6 relative z-10">
                                        "My son was unsure about his career path after graduation. iRiSEPro's scientific 7-step approach provided him with a clear roadmap and the confidence to pursue his goals."
                                    </p>
                                </div>
                                <div class="w-16 h-1 bg-primary mx-auto mt-6 opacity-50 group-hover:w-32 transition-all duration-500"></div>
                            </div>
                        </div>
                        
                        <!-- Student Testimonial 3 -->
                        <div class="bg-gradient-to-br from-white to-orange-50 p-6 rounded-xl shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl relative overflow-hidden group">
                            <!-- Decorative elements -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 group-hover:bg-primary/10 transition-all duration-500"></div>
                            <div class="absolute bottom-0 left-0 w-16 h-16 bg-primary/5 rounded-full -ml-8 -mb-8 group-hover:bg-primary/10 transition-all duration-500"></div>
                            
                            <div class="relative z-10">
                                <div class="flex items-center mb-6">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-gradient-to-br from-primary to-orange-400 rounded-full opacity-20 animate-pulse-slow"></div>
                                        <img src="https://placehold.co/100x100/F58321/FFFFFF/png?text=V" alt="Avatar" class="w-16 h-16 rounded-full border-2 border-primary relative z-10 shadow-md">
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="font-bold text-gray-800 text-lg">Vikram Singh</h4>
                                        <p class="text-primary text-sm font-medium">IT Student, Pune</p>
                                    </div>
                                </div>
                                <div class="pl-2">
                                    <span class="text-primary text-3xl absolute opacity-20"><i class="fas fa-quote-left"></i></span>
                                    <p class="text-gray-700 italic pl-6 relative z-10">
                                        "The growth roadmap provided by iRiSEPro was instrumental in helping me secure a placement. The personalized attention made all the difference in my career journey."
                                    </p>
                                </div>
                                <div class="w-16 h-1 bg-primary mx-auto mt-6 opacity-50 group-hover:w-32 transition-all duration-500"></div>
                            </div>
                        </div>
                        
                        <!-- Parent Testimonial 3 -->
                        <div class="bg-gradient-to-br from-white to-orange-50 p-6 rounded-xl shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl relative overflow-hidden group">
                            <!-- Decorative elements -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 group-hover:bg-primary/10 transition-all duration-500"></div>
                            <div class="absolute bottom-0 left-0 w-16 h-16 bg-primary/5 rounded-full -ml-8 -mb-8 group-hover:bg-primary/10 transition-all duration-500"></div>
                            
                            <div class="relative z-10">
                                <div class="flex items-center mb-6">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-gradient-to-br from-primary to-orange-400 rounded-full opacity-20 animate-pulse-slow"></div>
                                        <img src="https://placehold.co/100x100/F58321/FFFFFF/png?text=M" alt="Avatar" class="w-16 h-16 rounded-full border-2 border-primary relative z-10 shadow-md">
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="font-bold text-gray-800 text-lg">Meena Krishnan</h4>
                                        <p class="text-primary text-sm font-medium">Parent, Chennai</p>
                                    </div>
                                </div>
                                <div class="pl-2">
                                    <span class="text-primary text-3xl absolute opacity-20"><i class="fas fa-quote-left"></i></span>
                                    <p class="text-gray-700 italic pl-6 relative z-10">
                                        "As parents, we were impressed by the time-efficient approach of iRiSEPro. My daughter gained valuable insights and direction without compromising her academic studies."
                                    </p>
                                </div>
                                <div class="w-16 h-1 bg-primary mx-auto mt-6 opacity-50 group-hover:w-32 transition-all duration-500"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Carousel Navigation -->
                <div class="flex justify-center mt-8 space-x-4">
                    <button class="carousel-nav-btn active w-3 h-3 rounded-full bg-primary opacity-50 hover:opacity-100 transition-opacity" data-slide="0"></button>
                    <button class="carousel-nav-btn w-3 h-3 rounded-full bg-primary opacity-50 hover:opacity-100 transition-opacity" data-slide="1"></button>
                </div>
                
                <!-- Carousel Controls -->
                <button class="carousel-control prev absolute top-1/2 -left-4 transform -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-colors">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="carousel-control next absolute top-1/2 -right-4 transform -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-colors">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gray-50 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary opacity-5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary opacity-5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Get in Touch</h2>
                <div class="h-1.5 w-24 bg-gradient-to-r from-primary to-primary/70 mx-auto mb-6 rounded-full"></div>
                <p class="text-gray-700 max-w-3xl mx-auto">
                    Have questions or ready to accelerate your career? Reach out to our team for personalized guidance.
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Contact Form Card -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                        <div class="p-8">
                            <h3 class="text-2xl font-bold mb-6 flex items-center">
                                <span class="bg-gradient-to-r from-primary to-primary/70 text-white p-2 rounded-lg mr-3 shadow-lg">
                                    <i class="fas fa-paper-plane text-3xl"></i>
                                </span>
                                Send Us a Message
                            </h3>
                            
                            <form id="contact-form" class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="relative">
                                        <label for="name" class="block text-gray-700 mb-2 font-medium">Your Name</label>
                                        <div class="relative">
                                            <input type="text" id="name" name="name" required 
                                                class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                                            <i class="fas fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <label for="email" class="block text-gray-700 mb-2 font-medium">Email Address</label>
                                        <div class="relative">
                                            <input type="email" id="email" name="email" required 
                                                class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                                            <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative">
                                    <label for="subject" class="block text-gray-700 mb-2 font-medium">Subject</label>
                                    <div class="relative">
                                        <input type="text" id="subject" name="subject" required 
                                            class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                                        <i class="fas fa-tag absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    </div>
                                </div>
                                <div class="relative">
                                    <label for="message" class="block text-gray-700 mb-2 font-medium">Message</label>
                                    <div class="relative">
                                        <textarea id="message" name="message" rows="5" required 
                                            class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all"></textarea>
                                        <i class="fas fa-comment absolute left-3 top-6 text-gray-400"></i>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="w-full bg-gradient-to-r from-primary to-primary/80 text-white py-3 px-6 rounded-lg hover:shadow-lg hover:shadow-primary/30 transition-all duration-300 flex items-center justify-center">
                                        <i class="fas fa-paper-plane mr-2"></i> Send Message
                                    </button>
                                </div>
                                <div id="form-success" class="hidden bg-green-100 text-green-700 p-4 rounded-lg border border-green-200">
                                    <div class="flex items-center">
                                        <i class="fas fa-check-circle text-green-500 mr-2 text-xl"></i>
                                        <span>Thank you for your message! We'll get back to you soon.</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Information Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 h-full">
                        <div class="p-8">
                            <h3 class="text-2xl font-bold mb-6 flex items-center">
                                <span class="bg-gradient-to-r from-primary to-primary/70 text-white p-2 rounded-lg mr-3 shadow-lg">
                                    <i class="fas fa-address-card text-3xl"></i>
                                </span>
                                Contact Info
                            </h3>
                            
                            <div class="space-y-8">
                                <div class="flex items-start group">
                                    <div class="mr-4 bg-gray-100 p-3 rounded-lg group-hover:bg-primary/10 transition-colors">
                                        <i class="fas fa-map-marker-alt text-3xl text-primary"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-lg">Our Location</h4>
                                        <p class="text-gray-700">4th Floor, Rishab Arcade, Sanjay Nagar Main Rd, above Nirmala Jewellers, MET Layout, Geddalahalii, R.M.V. 2nd Stage, Bengaluru, Karnataka 560094</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start group">
                                    <div class="mr-4 bg-gray-100 p-3 rounded-lg group-hover:bg-primary/10 transition-colors">
                                        <i class="fas fa-phone text-3xl text-primary"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-lg">Call Us</h4>
                                        <p class="text-gray-700">+91 8660256342</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start group">
                                    <div class="mr-4 bg-gray-100 p-3 rounded-lg group-hover:bg-primary/10 transition-colors">
                                        <i class="fas fa-envelope text-3xl text-primary"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-lg">Email Us</h4>
                                        <p class="text-gray-700">contact@irisepro.in</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start group">
                                    <div class="mr-4 bg-gray-100 p-3 rounded-lg group-hover:bg-primary/10 transition-colors">
                                        <i class="fas fa-clock text-3xl text-primary"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-lg">Office Hours</h4>
                                        <p class="text-gray-700">Monday - Friday: 9:00 AM - 6:00 PM</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-10 pt-6 border-t border-gray-200">
                                <h4 class="font-bold text-lg mb-4">Connect With Us</h4>
                                <div class="flex space-x-4">
                                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center group hover:bg-primary transition-all duration-300 hover:scale-110" aria-label="Facebook">
                                        <i class="fab fa-facebook-f text-lg text-gray-600 group-hover:text-white"></i>
                                    </a>
                                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center group hover:bg-primary transition-all duration-300 hover:scale-110" aria-label="Twitter">
                                        <i class="fab fa-twitter text-lg text-gray-600 group-hover:text-white"></i>
                                    </a>
                                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center group hover:bg-primary transition-all duration-300 hover:scale-110" aria-label="LinkedIn">
                                        <i class="fab fa-linkedin-in text-lg text-gray-600 group-hover:text-white"></i>
                                    </a>
                                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center group hover:bg-primary transition-all duration-300 hover:scale-110" aria-label="Instagram">
                                        <i class="fab fa-instagram text-lg text-gray-600 group-hover:text-white"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('landing.partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeIn');
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.feature-card, .stat-card').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>
