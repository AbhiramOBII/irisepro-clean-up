<!-- Statistics Section -->
<section id="stats" class="stats-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="display-5 fw-bold mb-4">Our Impact in Numbers</h2>
                <p class="lead text-muted">See how iRisePro is making a difference in the lives of learners and professionals worldwide.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <span class="stat-number counter" data-target="10000">0</span>
                    <h5 class="fw-bold mt-2">Active Learners</h5>
                    <p class="text-muted mb-0">Students actively engaged in learning</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <span class="stat-number counter" data-target="500">0</span>
                    <h5 class="fw-bold mt-2">Courses Available</h5>
                    <p class="text-muted mb-0">Comprehensive learning modules</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <span class="stat-number counter" data-target="95">0</span>
                    <span class="stat-number">%</span>
                    <h5 class="fw-bold mt-2">Success Rate</h5>
                    <p class="text-muted mb-0">Students achieving their goals</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <span class="stat-number counter" data-target="50">0</span>
                    <span class="stat-number">+</span>
                    <h5 class="fw-bold mt-2">Countries</h5>
                    <p class="text-muted mb-0">Global reach and impact</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Counter animation
function animateCounters() {
    const counters = document.querySelectorAll('.counter');
    
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const increment = target / 100;
        let current = 0;
        
        const updateCounter = () => {
            if (current < target) {
                current += increment;
                counter.textContent = Math.floor(current);
                setTimeout(updateCounter, 20);
            } else {
                counter.textContent = target;
            }
        };
        
        updateCounter();
    });
}

// Trigger animation when section is visible
const statsSection = document.getElementById('stats');
if (statsSection) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                observer.unobserve(entry.target);
            }
        });
    });
    
    observer.observe(statsSection);
}
</script>
