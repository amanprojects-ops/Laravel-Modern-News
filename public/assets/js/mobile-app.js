/**
 * TazBlog Mobile App JavaScript
 * Handles all interactive elements for the mobile-first design
 * Includes SabkeBot PWA installation assistant
 */

// PWA installation variables
let deferredPrompt;
let installPromptShown = false;

// Check if the app is already installed
const isAppInstalled = () => {
    return window.matchMedia('(display-mode: standalone)').matches || 
           window.navigator.standalone || // iOS Safari
           document.referrer.includes('android-app://'); // Android Chrome
};

// Register service worker for PWA functionality
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/service-worker.js')
            .then(registration => {
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            })
            .catch(err => {
                console.log('ServiceWorker registration failed: ', err);
            });
    });
}

// Listen for the beforeinstallprompt event
window.addEventListener('beforeinstallprompt', (e) => {
    // Prevent Chrome 67 and earlier from automatically showing the prompt
    e.preventDefault();
    // Stash the event so it can be triggered later
    deferredPrompt = e;
    
    // Show the SabkeBot only if the app is not installed
    if (!isAppInstalled() && !installPromptShown) {
        setTimeout(() => {
            document.getElementById('sabkebot-container').classList.add('show');
            installPromptShown = true;
        }, 3000); // Show after 3 seconds
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Mobile Navigation Toggle
    const navToggle = document.querySelector('.nav-toggle');
    const navbar = document.querySelector('.navbar');
    
    if (navToggle) {
        navToggle.addEventListener('click', function() {
            navbar.classList.toggle('active');
        });
    }

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const isClickInsideNav = navbar.contains(event.target) || navToggle.contains(event.target);
        if (!isClickInsideNav && navbar.classList.contains('active')) {
            navbar.classList.remove('active');
        }
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Back to top button functionality
    const backToTopBtn = document.querySelector('.back-to-top');
    if (backToTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });

        backToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Add active class to current page in navigation
    const currentLocation = window.location.pathname;
    const menuItems = document.querySelectorAll('.navbar ul li a');
    menuItems.forEach(item => {
        const href = item.getAttribute('href');
        if (href && currentLocation.includes(href) && href !== '/' && href !== '/home') {
            item.classList.add('active');
        } else if ((currentLocation === '/' || currentLocation.includes('/home') || currentLocation.endsWith('tazblog/')) && 
                 (href === '/' || href === '/home' || href.endsWith('tazblog/'))) {
            item.classList.add('active');
        }
    });

    // Lazy loading images for better performance
    if ('loading' in HTMLImageElement.prototype) {
        // Browser supports native lazy loading
        const images = document.querySelectorAll('img[loading="lazy"]');
        // images.forEach(img => {
        //     img.src = img.dataset.src;
        // });
    } else {
        // Fallback for browsers that don't support lazy loading
        const script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
        document.body.appendChild(script);
    }
    
    // SabkeBot functionality
    const sabkebotContainer = document.getElementById('sabkebot-container');
    const installBtn = document.getElementById('install-pwa-btn');
    const closeSabkebotBtn = document.getElementById('close-sabkebot');
    
    // Only show SabkeBot if the app is not installed
    if (sabkebotContainer && !isAppInstalled()) {
        if (deferredPrompt) {
            setTimeout(() => {
                sabkebotContainer.classList.add('show');
                installPromptShown = true;
            }, 3000); // Show after 3 seconds
        }
        
        // Handle install button click
        if (installBtn) {
            installBtn.addEventListener('click', async () => {
                if (deferredPrompt) {
                    // Show the installation prompt
                    deferredPrompt.prompt();
                    // Wait for the user to respond to the prompt
                    const { outcome } = await deferredPrompt.userChoice;
                    console.log(`User response to the install prompt: ${outcome}`);
                    // We've used the prompt, and can't use it again, discard it
                    deferredPrompt = null;
                } else {
                    // Fallback for iOS or when prompt isn't available
                    alert('To install this app on your home screen: tap the share icon and then "Add to Home Screen".');
                }
                // Hide SabkeBot after installation attempt
                sabkebotContainer.classList.remove('show');
            });
        }
        
        // Handle close button click
        if (closeSabkebotBtn) {
            closeSabkebotBtn.addEventListener('click', () => {
                sabkebotContainer.classList.remove('show');
                // Store in session storage that user closed the prompt
                sessionStorage.setItem('sabkebot-closed', 'true');
            });
        }
        
        // Check if user previously closed the prompt in this session
        if (sessionStorage.getItem('sabkebot-closed') === 'true') {
            sabkebotContainer.classList.remove('show');
        }
    }
});
