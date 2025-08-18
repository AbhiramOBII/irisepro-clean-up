// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle with enhanced animation
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = menuToggle ? menuToggle.querySelector('i') : null;
    const header = document.querySelector('header');
    let menuOpen = false;
    
    // Function to handle header scroll effect
    const handleHeaderScroll = () => {
        const scrollY = window.scrollY;
        const navSection = header ? header.querySelector('section.sticky') : null;
        
        if (navSection && scrollY > 100) {
            navSection.classList.add('shadow-md');
            navSection.classList.add('py-3');
            navSection.classList.remove('py-4');
        } else if (navSection) {
            navSection.classList.remove('shadow-md');
            navSection.classList.remove('py-3');
            navSection.classList.add('py-4');
        }
    };
    
    // Add scroll event listener for header effects
    window.addEventListener('scroll', handleHeaderScroll);
    
    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', function() {
            menuOpen = !menuOpen;
            
            if (menuOpen) {
                // Open menu with animation
                mobileMenu.classList.remove('hidden');
                // Allow a tiny delay for the display change before animating
                setTimeout(() => {
                    mobileMenu.classList.remove('opacity-0', '-translate-y-2');
                    // Change icon to X
                    if (menuIcon) {
                        menuIcon.classList.remove('fa-bars');
                        menuIcon.classList.add('fa-times');
                    }
                }, 10);
            } else {
                // Close menu with animation
                mobileMenu.classList.add('opacity-0', '-translate-y-2');
                // Change icon back to bars
                if (menuIcon) {
                    menuIcon.classList.remove('fa-times');
                    menuIcon.classList.add('fa-bars');
                }
                // Wait for animation to finish before hiding
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
            }
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (menuOpen && !mobileMenu.contains(e.target) && !menuToggle.contains(e.target)) {
                menuToggle.click();
            }
        });
        
        // Close mobile menu when window is resized to desktop size
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768 && menuOpen) {
                menuToggle.click();
            }
        });
    }
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                // Close mobile menu if open
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    menuToggle.click();
                }
                
                // Scroll to target
                window.scrollTo({
                    top: targetElement.offsetTop - 80, // Offset for fixed header
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Animate elements when they come into view
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.animate-on-scroll');
        
        elements.forEach((element) => {
            const elementPosition = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (elementPosition < windowHeight - 100) {
                const animationClass = element.dataset.animation || 'fade-in';
                element.classList.add(animationClass);
                element.classList.remove('animate-on-scroll');
            }
        });
    };
    
    // Run animation check on load and scroll
    animateOnScroll();
    window.addEventListener('scroll', animateOnScroll);
    
    // Counter animation for statistics
    const animateCounter = function(element, target) {
        let current = 0;
        const increment = target / 100;
        const duration = 2000; // 2 seconds
        const interval = duration / 100;
        
        const timer = setInterval(function() {
            current += increment;
            element.textContent = Math.round(current);
            
            if (current >= target) {
                element.textContent = target;
                clearInterval(timer);
            }
        }, interval);
    };
    
    // Initialize counters when they come into view
    const initCounters = function() {
        const counters = document.querySelectorAll('.counter');
        
        counters.forEach((counter) => {
            const elementPosition = counter.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (elementPosition < windowHeight - 100 && !counter.classList.contains('counted')) {
                const target = parseInt(counter.getAttribute('data-target'));
                animateCounter(counter, target);
                counter.classList.add('counted');
            }
        });
    };
    
    // Run counter animation on scroll
    window.addEventListener('scroll', initCounters);
    
    // Hero Carousel Functionality
    const heroCarouselSetup = function() {
        const carouselContainer = document.querySelector('.hero-carousel-container');
        if (!carouselContainer) return;
        
        const slidesContainer = carouselContainer.querySelector('.hero-carousel-slides');
        const slides = carouselContainer.querySelectorAll('.hero-carousel-slide');
        const totalSlides = slides.length;
        
        if (totalSlides <= 1) return;
        
        let currentIndex = 0;
        let autoSlideInterval;
        
        // Create navigation buttons
        const prevBtn = document.createElement('button');
        prevBtn.className = 'hero-carousel-btn absolute left-4 top-1/2 transform -translate-y-1/2 z-10';
        prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
        carouselContainer.appendChild(prevBtn);
        
        const nextBtn = document.createElement('button');
        nextBtn.className = 'hero-carousel-btn absolute right-4 top-1/2 transform -translate-y-1/2 z-10';
        nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
        carouselContainer.appendChild(nextBtn);
        
        // Create indicators
        const indicatorsContainer = document.createElement('div');
        indicatorsContainer.className = 'hero-carousel-indicators absolute bottom-6 left-0 right-0';
        
        const indicators = [];
        for (let i = 0; i < totalSlides; i++) {
            const indicator = document.createElement('button');
            indicator.className = 'hero-carousel-indicator';
            indicatorsContainer.appendChild(indicator);
            indicators.push(indicator);
        }
        
        carouselContainer.appendChild(indicatorsContainer);
        
        // Reset interval on manual navigation
        const resetInterval = function() {
            clearInterval(autoSlideInterval);
            autoSlideInterval = setInterval(nextSlide, 6000);
        };
        
        // Next slide function
        const nextSlide = function() {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateCarousel();
        };
        
        // Previous slide function
        const prevSlide = function() {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateCarousel();
        };
        
        // Update carousel position and indicators
        const updateCarousel = function() {
            slidesContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
            
            indicators.forEach((indicator, index) => {
                if (index === currentIndex) {
                    indicator.classList.add('active');
                    indicator.style.backgroundColor = '#F58321';
                } else {
                    indicator.classList.remove('active');
                    indicator.style.backgroundColor = 'rgba(255, 255, 255, 0.5)';
                }
            });
        };
        
        // Event listeners
        nextBtn.addEventListener('click', function() {
            nextSlide();
            resetInterval();
        });
        
        prevBtn.addEventListener('click', function() {
            prevSlide();
            resetInterval();
        });
        
        // Indicator clicks
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', function() {
                currentIndex = index;
                updateCarousel();
                resetInterval();
            });
        });
        
        // Pause auto-slide on hover
        carouselContainer.addEventListener('mouseenter', function() {
            clearInterval(autoSlideInterval);
        });
        
        // Resume auto-slide on mouse leave
        carouselContainer.addEventListener('mouseleave', function() {
            autoSlideInterval = setInterval(nextSlide, 6000);
        });
        
        // Touch support for mobile
        let touchStartX = 0;
        let touchEndX = 0;
        
        carouselContainer.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });
        
        carouselContainer.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });
        
        const handleSwipe = function() {
            const swipeThreshold = 50;
            if (touchEndX < touchStartX - swipeThreshold) {
                // Swipe left - next slide
                nextSlide();
                resetInterval();
            } else if (touchEndX > touchStartX + swipeThreshold) {
                // Swipe right - previous slide
                prevSlide();
                resetInterval();
            }
        };
        
        // Initialize
        updateCarousel();
        autoSlideInterval = setInterval(nextSlide, 6000);
    };
    
    // Initialize hero carousel
    heroCarouselSetup();
    
    // Form validation
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic validation
            let valid = true;
            const requiredFields = contactForm.querySelectorAll('[required]');
            
            requiredFields.forEach((field) => {
                if (!field.value.trim()) {
                    valid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            // Email validation
            const emailField = contactForm.querySelector('input[type="email"]');
            if (emailField && emailField.value) {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(emailField.value)) {
                    valid = false;
                    emailField.classList.add('border-red-500');
                }
            }
            
            if (valid) {
                // Show success message (in a real application, you would submit the form data here)
                const successMessage = document.getElementById('form-success');
                if (successMessage) {
                    successMessage.classList.remove('hidden');
                    contactForm.reset();
                    
                    // Hide success message after 5 seconds
                    setTimeout(function() {
                        successMessage.classList.add('hidden');
                    }, 5000);
                }
            }
        });
    }
});
