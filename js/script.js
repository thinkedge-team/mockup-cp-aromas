/* ========================================
   AROMAS - PREMIUM PALM OIL & COOKING OIL
   Custom JavaScript
   ======================================== */

// ========== PRELOADER ==========
window.addEventListener('load', function() {
    const preloader = document.getElementById('preloader');
    if (preloader) {
        // Add a small delay for smooth transition
        setTimeout(function() {
            preloader.classList.add('hidden');
            // Remove from DOM after animation completes
            setTimeout(function() {
                preloader.style.display = 'none';
            }, 600);
        }, 800);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    
    // ========== INITIALIZATION ==========
    initNavbarScroll();
    initSmoothScroll();
    initAccordion();
    initCounterAnimation();
    initScrollAnimations();
    initBackToTop();
    initVideoModal();
    initMobileMenu();
    
    console.log('AROMAS website initialized successfully!');
});

// ========== NAVBAR SCROLL EFFECT ==========
function initNavbarScroll() {
    const navbar = document.querySelector('.navbar');
    const navLinks = document.querySelectorAll('.nav-link');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        
        // Update active nav link based on scroll position
        updateActiveNavLink();
    });
}

// Update active navigation link based on current section
function updateActiveNavLink() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    
    let currentSection = '';
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop - 100;
        const sectionHeight = section.offsetHeight;
        
        if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
            currentSection = section.getAttribute('id');
        }
    });
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${currentSection}`) {
            link.classList.add('active');
        }
    });
}

// ========== SMOOTH SCROLL ==========
function initSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (!targetElement) return;
            
            const headerOffset = 80;
            const elementPosition = targetElement.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
            
            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
            
            // Close mobile menu if open
            const navbarCollapse = document.querySelector('.navbar-collapse');
            if (navbarCollapse.classList.contains('show')) {
                const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                if (bsCollapse) {
                    bsCollapse.hide();
                }
            }
        });
    });
}

// ========== SERVICES ACCORDION ==========
function initAccordion() {
    const accordionItems = document.querySelectorAll('.accordion-item');
    
    accordionItems.forEach(item => {
        const header = item.querySelector('.accordion-header');
        const content = item.querySelector('.accordion-content');
        const toggle = item.querySelector('.accordion-toggle i');
        
        header.addEventListener('click', function() {
            const isActive = item.classList.contains('active');
            
            // Close all accordion items
            accordionItems.forEach(otherItem => {
                otherItem.classList.remove('active');
                const otherContent = otherItem.querySelector('.accordion-content');
                const otherToggle = otherItem.querySelector('.accordion-toggle i');
                
                otherContent.classList.remove('show');
                otherToggle.className = 'bi bi-plus-lg';
            });
            
            // Open clicked item if it wasn't active
            if (!isActive) {
                item.classList.add('active');
                content.classList.add('show');
                toggle.className = 'bi bi-dash-lg';
            }
        });
    });
}

// ========== COUNTER ANIMATION ==========
function initCounterAnimation() {
    const counters = document.querySelectorAll('.counter');
    let countersAnimated = false;
    
    function animateCounters() {
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000; // Animation duration in ms
            const increment = target / (duration / 16); // 60fps
            
            let current = 0;
            
            const updateCounter = () => {
                current += increment;
                
                if (current < target) {
                    counter.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };
            
            updateCounter();
        });
    }
    
    // Intersection Observer for counter animation
    const impactSection = document.querySelector('.impact-section');
    
    if (impactSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !countersAnimated) {
                    countersAnimated = true;
                    animateCounters();
                }
            });
        }, {
            threshold: 0.5
        });
        
        observer.observe(impactSection);
    }
}

// ========== SCROLL ANIMATIONS (AOS-like) ==========
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll('[data-aos]');
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add delay if specified
                const delay = entry.target.getAttribute('data-aos-delay') || 0;
                
                setTimeout(() => {
                    entry.target.classList.add('aos-animate');
                }, delay);
                
                // Optionally unobserve after animation
                // observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    animatedElements.forEach(element => {
        observer.observe(element);
    });
}

// ========== BACK TO TOP BUTTON ==========
function initBackToTop() {
    const backToTopBtn = document.getElementById('backToTop');
    
    if (!backToTopBtn) return;
    
    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
        if (window.scrollY > 500) {
            backToTopBtn.classList.add('show');
        } else {
            backToTopBtn.classList.remove('show');
        }
    });
    
    // Scroll to top on click
    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// ========== VIDEO MODAL ==========
function initVideoModal() {
    const videoModal = document.getElementById('videoModal');
    const videoIframe = document.getElementById('videoIframe');
    
    if (!videoModal || !videoIframe) return;
    
    // Sample video URL (replace with actual video)
    const videoURL = 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1';
    
    videoModal.addEventListener('show.bs.modal', function() {
        videoIframe.src = videoURL;
    });
    
    videoModal.addEventListener('hide.bs.modal', function() {
        videoIframe.src = '';
    });
}

// ========== MOBILE MENU ENHANCEMENTS ==========
function initMobileMenu() {
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (!navbarToggler || !navbarCollapse) return;
    
    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        const isClickInsideNav = navbarCollapse.contains(e.target);
        const isClickOnToggler = navbarToggler.contains(e.target);
        
        if (!isClickInsideNav && !isClickOnToggler && navbarCollapse.classList.contains('show')) {
            const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
            if (bsCollapse) {
                bsCollapse.hide();
            }
        }
    });
    
    // Add animation class to toggler
    navbarToggler.addEventListener('click', function() {
        this.classList.toggle('active');
    });
}

// ========== BLOG CAROUSEL NAVIGATION ==========
document.addEventListener('DOMContentLoaded', function() {
    const prevBtn = document.querySelector('.blog-nav .prev');
    const nextBtn = document.querySelector('.blog-nav .next');
    const blogCards = document.querySelectorAll('.blog-card');
    
    if (!prevBtn || !nextBtn) return;
    
    let currentIndex = 0;
    
    // Simple visual feedback for navigation buttons
    prevBtn.addEventListener('click', function() {
        // Add click animation
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
            this.style.transform = '';
        }, 150);
        
        // In a real implementation, this would navigate to previous blog posts
        console.log('Navigate to previous blog posts');
    });
    
    nextBtn.addEventListener('click', function() {
        // Add click animation
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
            this.style.transform = '';
        }, 150);
        
        // In a real implementation, this would navigate to next blog posts
        console.log('Navigate to next blog posts');
    });
});

// ========== PARALLAX EFFECT (Optional) ==========
function initParallax() {
    const parallaxSections = document.querySelectorAll('.hero-section, .impact-section, .video-section');
    
    window.addEventListener('scroll', function() {
        parallaxSections.forEach(section => {
            const scrolled = window.pageYOffset;
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            
            if (scrolled >= sectionTop - window.innerHeight && scrolled <= sectionTop + sectionHeight) {
                const rate = (scrolled - sectionTop) * 0.3;
                section.style.backgroundPositionY = `${rate}px`;
            }
        });
    });
}

// ========== FORM VALIDATION (For Contact Form if added) ==========
function validateForm(formElement) {
    const inputs = formElement.querySelectorAll('input[required], textarea[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
            input.classList.add('is-invalid');
        } else {
            input.classList.remove('is-invalid');
        }
        
        // Email validation
        if (input.type === 'email' && input.value) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(input.value)) {
                isValid = false;
                input.classList.add('is-invalid');
            }
        }
    });
    
    return isValid;
}

// ========== LOADING ANIMATION ==========
window.addEventListener('load', function() {
    // Remove loading state
    document.body.classList.add('loaded');
    
    // Trigger initial animations
    setTimeout(() => {
        const heroContent = document.querySelector('.hero-content');
        if (heroContent) {
            heroContent.classList.add('aos-animate');
        }
    }, 300);
});

// ========== UTILITY FUNCTIONS ==========

// Debounce function for performance
function debounce(func, wait = 20) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Throttle function for scroll events
function throttle(func, limit = 100) {
    let inThrottle;
    return function(...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Check if element is in viewport
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// ========== PRELOADER (Optional) ==========
function hidePreloader() {
    const preloader = document.querySelector('.preloader');
    if (preloader) {
        preloader.style.opacity = '0';
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 500);
    }
}

// ========== LAZY LOADING FOR IMAGES ==========
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                observer.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
}

// ========== HOVER EFFECTS FOR CARDS ==========
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.hero-card, .blog-card, .benefit-card, .impact-card');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });
});

// ========== RESIZE HANDLER ==========
window.addEventListener('resize', debounce(function() {
    // Handle any resize-specific logic here
    updateActiveNavLink();
}, 250));
