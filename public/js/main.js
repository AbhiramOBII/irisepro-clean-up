// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle with enhanced slide-out animation
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const closeMenuBtn = document.getElementById('close-menu');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
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
    
    // Function to open mobile menu
    const openMobileMenu = () => {
        menuOpen = true;
        
        // Add active class to menu toggle for hamburger animation
        if (menuToggle) {
            menuToggle.classList.add('active');
        }
        
        // Show overlay first
        mobileMenuOverlay.classList.remove('hidden');
        // Allow a tiny delay for the display change before animating
        setTimeout(() => {
            mobileMenuOverlay.classList.remove('opacity-0');
        }, 10);
        
        // Show menu
        mobileMenu.classList.remove('hidden');
        // Allow a tiny delay for the display change before animating
        setTimeout(() => {
            mobileMenu.classList.remove('opacity-0', 'translate-x-full');
        }, 10);
        
        // Prevent body scrolling
        document.body.style.overflow = 'hidden';
    };
    
    // Function to close mobile menu
    const closeMobileMenu = () => {
        menuOpen = false;
        
        // Remove active class from menu toggle
        if (menuToggle) {
            menuToggle.classList.remove('active');
        }
        
        // Hide menu with animation
        mobileMenu.classList.add('opacity-0', 'translate-x-full');
        mobileMenuOverlay.classList.add('opacity-0');
        
        // Wait for animation to finish before hiding
        setTimeout(() => {
            mobileMenu.classList.add('hidden');
            mobileMenuOverlay.classList.add('hidden');
            // Restore body scrolling
            document.body.style.overflow = '';
        }, 300);
    };
    
    if (menuToggle && mobileMenu) {
        // Open menu when clicking the toggle button
        menuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            if (!menuOpen) {
                openMobileMenu();
            } else {
                closeMobileMenu();
            }
        });
        
        // Close menu when clicking the close button
        if (closeMenuBtn) {
            closeMenuBtn.addEventListener('click', closeMobileMenu);
        }
        
        // Close menu when clicking the overlay
        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', closeMobileMenu);
        }
        
        // Close menu when clicking menu links
        const menuLinks = mobileMenu.querySelectorAll('a[href^="#"]');
        menuLinks.forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });
        
        // Close mobile menu when window is resized to desktop size
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768 && menuOpen) {
                closeMobileMenu();
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
    const animateCounter = (element, target) => {
        const duration = 2000; // Animation duration in milliseconds
        const start = parseInt(element.textContent, 10);
        const increment = target / (duration / 16); // Update every ~16ms for 60fps
        let current = start;
        
        const updateCounter = () => {
            current += increment;
            if (current < target) {
                element.textContent = Math.round(current);
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target.toLocaleString(); // Format with commas for thousands
            }
        };
        
        updateCounter();
    };
    
    // Initialize counters when they come into view
    const initCounters = function() {
        const counters = document.querySelectorAll('.counter');
        
        counters.forEach(function(counter) {
            // Check if counter is in viewport and not already animated
            const rect = counter.getBoundingClientRect();
            const isInViewport = (
                rect.top >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
            );
            
            if (isInViewport && !counter.classList.contains('animated')) {
                counter.classList.add('animated');
                const target = parseInt(counter.getAttribute('data-target'), 10);
                animateCounter(counter, target);
            }
        });
    };
    
    // Initialize counters on page load
    initCounters();
    
    // Run counter animation on scroll
    window.addEventListener('scroll', initCounters);
    
    // Enhanced Hero Carousel Functionality
    const heroCarouselSetup = function() {
        const carouselSection = document.querySelector('.hero-carousel-section');
        if (!carouselSection) return;
        
        const carouselContainer = carouselSection.querySelector('.hero-carousel-container');
        const slidesContainer = carouselSection.querySelector('.hero-carousel-slides');
        const slides = carouselSection.querySelectorAll('.hero-carousel-slide');
        const nextBtn = carouselSection.querySelector('.hero-carousel-btn.next');
        const prevBtn = carouselSection.querySelector('.hero-carousel-btn.prev');
        const indicators = carouselSection.querySelectorAll('.hero-carousel-indicator');
        const progressBar = document.getElementById('carousel-progress');
        
        // If no slides found, exit
        if (!slides.length) return;
        
        let currentIndex = 0;
        let autoSlideInterval;
        const slideDuration = 8000; // 8 seconds per slide
        let progressInterval;
        
        // Create screen reader live region for accessibility
        const createLiveRegion = () => {
            const region = document.createElement('div');
            region.id = 'carousel-live-region';
            region.setAttribute('aria-live', 'polite');
            region.setAttribute('aria-atomic', 'true');
            region.classList.add('sr-only'); // Screen reader only
            region.style.position = 'absolute';
            region.style.width = '1px';
            region.style.height = '1px';
            region.style.overflow = 'hidden';
            document.body.appendChild(region);
            return region;
        };
        
        // Create live region on init
        const liveRegion = createLiveRegion();
        
        // Show the current slide content with animation
        const animateSlideContent = (index) => {
            // Hide all slide content first
            document.querySelectorAll('.slide-content').forEach(content => {
                content.classList.add('opacity-0', 'translate-y-8');
            });
            
            // Show the current slide content with animation
            const currentSlideContent = slides[index].querySelector('.slide-content');
            if (currentSlideContent) {
                setTimeout(() => {
                    currentSlideContent.classList.remove('opacity-0', 'translate-y-8');
                }, 300); // Slight delay after slide transition starts
            }
        };
        
        // Progress bar animation
        const startProgressBar = () => {
            // Reset progress bar
            if (progressBar) {
                progressBar.style.width = '0%';
                clearInterval(progressInterval);
                
                // Animate progress bar
                const startTime = Date.now();
                progressInterval = setInterval(() => {
                    const elapsedTime = Date.now() - startTime;
                    const progress = Math.min((elapsedTime / slideDuration) * 100, 100);
                    progressBar.style.width = `${progress}%`;
                    
                    if (progress >= 100) {
                        clearInterval(progressInterval);
                    }
                }, 30);
            }
        };
        
        // Reset interval on manual navigation
        const resetInterval = function() {
            clearInterval(autoSlideInterval);
            autoSlideInterval = setInterval(nextSlide, slideDuration);
            startProgressBar();
        };
        
        // Next slide function
        const nextSlide = function() {
            currentIndex = (currentIndex + 1) % slides.length;
            updateCarousel();
        };
        
        // Previous slide function
        const prevSlide = function() {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            updateCarousel();
        };
        
        // Update carousel position and indicators
        const updateCarousel = function() {
            // Update slides position with smooth transition
            slidesContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
            
            // Animate the current slide content
            animateSlideContent(currentIndex);
            
            // Restart progress bar
            startProgressBar();
            
            // Update active class on slides for zoom effect
            slides.forEach((slide, index) => {
                if (index === currentIndex) {
                    slide.classList.add('active');
                } else {
                    slide.classList.remove('active');
                }
            });
            
            // Update indicators
            indicators.forEach((indicator, index) => {
                if (index === currentIndex) {
                    indicator.classList.add('active');
                    indicator.style.transform = 'scale(1.2)';
                    indicator.style.backgroundColor = '#F58321';
                } else {
                    indicator.classList.remove('active');
                    indicator.style.transform = 'scale(1)';
                    indicator.style.backgroundColor = 'rgba(255, 255, 255, 0.6)';
                }
            });
            
            // Announce slide change for screen readers
            if (liveRegion) {
                const slideLabel = slides[currentIndex].getAttribute('aria-label') || `Slide ${currentIndex + 1}`;
                liveRegion.textContent = `Showing ${slideLabel}, slide ${currentIndex + 1} of ${slides.length}`;
            }
        };
        
        // Add event listeners
        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                nextSlide();
                resetInterval();
            });
        }
        
        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                prevSlide();
                resetInterval();
            });
        }
        
        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            // Only respond to keyboard events when carousel is in viewport
            const rect = carouselSection.getBoundingClientRect();
            const isInViewport = (
                rect.top < (window.innerHeight || document.documentElement.clientHeight) &&
                rect.bottom > 0 &&
                rect.left < (window.innerWidth || document.documentElement.clientWidth) &&
                rect.right > 0
            );
            
            if (isInViewport) {
                if (e.key === 'ArrowRight') {
                    nextSlide();
                    resetInterval();
                } else if (e.key === 'ArrowLeft') {
                    prevSlide();
                    resetInterval();
                }
            }
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
        if (carouselContainer) {
            carouselContainer.addEventListener('mouseenter', function() {
                clearInterval(autoSlideInterval);
                clearInterval(progressInterval);
                if (progressBar) {
                    // Freeze progress bar at current width
                    const currentWidth = progressBar.style.width;
                    progressBar.style.width = currentWidth;
                }
            });
            
            // Resume auto-slide on mouse leave
            carouselContainer.addEventListener('mouseleave', function() {
                autoSlideInterval = setInterval(nextSlide, slideDuration);
                startProgressBar();
            });
        }
        
        // Touch support for mobile
        let touchStartX = 0;
        let touchEndX = 0;
        
        if (carouselContainer) {
            carouselContainer.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
                // Pause progress bar on touch
                clearInterval(progressInterval);
            }, { passive: true });
            
            carouselContainer.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, { passive: true });
        }
        
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
            } else {
                // Resume progress if no swipe action taken
                startProgressBar();
            }
        };
        
        // Initialize
        updateCarousel();
        autoSlideInterval = setInterval(nextSlide, slideDuration);
        
        // Add CSS class to indicate JS is loaded and working
        carouselSection.classList.add('carousel-initialized');
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
    
    // Modal Functionality
    const modalOverlay = document.getElementById('modal-overlay');
    const transformationModal = document.getElementById('transformation-modal');
    const openModalBtn = document.getElementById('open-modal-btn');
    const closeModalBtn = document.getElementById('close-modal-btn');
    const transformationForm = document.getElementById('transformation-form');
    
    // Function to open modal with animation
    const openModal = () => {
        // Show overlay first
        modalOverlay.classList.remove('hidden');
        // Allow a tiny delay for the display change before animating
        setTimeout(() => {
            modalOverlay.classList.add('opacity-100');
            transformationModal.classList.add('opacity-100', 'scale-100');
            transformationModal.classList.remove('scale-95');
        }, 10);
        
        // Prevent body scrolling
        document.body.style.overflow = 'hidden';
    };
    
    // Function to close modal with animation
    const closeModal = () => {
        // Hide with animation
        modalOverlay.classList.remove('opacity-100');
        transformationModal.classList.remove('opacity-100', 'scale-100');
        transformationModal.classList.add('scale-95');
        
        // Wait for animation to finish before hiding
        setTimeout(() => {
            modalOverlay.classList.add('hidden');
            // Restore body scrolling
            document.body.style.overflow = '';
        }, 300);
    };
    
    // Event listeners for modal
    if (openModalBtn) {
        openModalBtn.addEventListener('click', function(e) {
            e.preventDefault();
            openModal();
        });
    }
    
    // Event listener for the second modal button (Explore Our Programs)
    const exploreModalBtn = document.getElementById('explore-modal-btn');
    if (exploreModalBtn) {
        exploreModalBtn.addEventListener('click', function(e) {
            e.preventDefault();
            openModal();
        });
    }
    
    // Event listener for the third modal button (Enroll Now)
    const enrollModalBtn = document.getElementById('enroll-modal-btn');
    if (enrollModalBtn) {
        enrollModalBtn.addEventListener('click', function(e) {
            e.preventDefault();
            openModal();
        });
    }
    
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', closeModal);
    }
    
    // Close modal when clicking outside
    if (modalOverlay) {
        modalOverlay.addEventListener('click', function(e) {
            if (e.target === modalOverlay) {
                closeModal();
            }
        });
    }
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modalOverlay.classList.contains('hidden')) {
            closeModal();
        }
    });
    
    // Form validation and submission
    if (transformationForm) {
        transformationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic validation
            let valid = true;
            const requiredFields = transformationForm.querySelectorAll('[required]');
            
            requiredFields.forEach((field) => {
                if (!field.value.trim()) {
                    valid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            // Email validation
            const emailField = transformationForm.querySelector('input[type="email"]');
            if (emailField && emailField.value) {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(emailField.value)) {
                    valid = false;
                    emailField.classList.add('border-red-500');
                }
            }
            
            if (valid) {
                // Show success message (in a real application, you would submit the form data here)
                const successMessage = document.getElementById('modal-form-success');
                if (successMessage) {
                    successMessage.classList.remove('hidden');
                    transformationForm.reset();
                    
                    // Hide success message after 5 seconds
                    setTimeout(function() {
                        successMessage.classList.add('hidden');
                        // Close the modal after showing success message
                        setTimeout(function() {
                            closeModal();
                        }, 1000);
                    }, 4000);
                }
            }
            
            // Phone validation (basic format check)
            const phoneField = transformationForm.querySelector('input[type="tel"]');
            if (phoneField && phoneField.value) {
                // Allow digits, spaces, dashes, and parentheses
                const phonePattern = /^[\d\s\-\(\)\+]+$/;
                if (!phonePattern.test(phoneField.value)) {
                    valid = false;
                    phoneField.classList.add('border-red-500');
                }
            }
            
            if (valid) {
                // In a real application, you would submit the form data to a server here
                // For now, we'll just show a success message
                const successMessage = document.getElementById('form-success');
                if (successMessage) {
                    successMessage.classList.remove('hidden');
                    transformationForm.reset();
                    
                    // Hide success message and close modal after 3 seconds
                    setTimeout(function() {
                        successMessage.classList.add('hidden');
                        closeModal();
                    }, 3000);
                }
            }
        });
        
        // Remove validation styling on input
        const formInputs = transformationForm.querySelectorAll('input, select');
        formInputs.forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('border-red-500');
            });
        });
    }
});
