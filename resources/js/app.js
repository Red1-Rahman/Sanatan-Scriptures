import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Dark Mode Toggle
const themeToggleBtn = document.getElementById('theme-toggle');
const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

// Check for saved theme preference or default to light mode
const currentTheme = localStorage.getItem('theme') || 'light';

// Set initial theme
if (currentTheme === 'dark') {
    document.documentElement.classList.add('dark');
    themeToggleLightIcon.classList.remove('hidden');
} else {
    document.documentElement.classList.remove('dark');
    themeToggleDarkIcon.classList.remove('hidden');
}

// Toggle theme
if (themeToggleBtn) {
    themeToggleBtn.addEventListener('click', function() {
        // Toggle icons
        themeToggleDarkIcon.classList.toggle('hidden');
        themeToggleLightIcon.classList.toggle('hidden');

        // Toggle dark mode
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
    });
}

// Toast Notification System
window.showToast = function(message, type = 'success') {
    const toast = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-green-500' : 
                    type === 'error' ? 'bg-red-500' : 
                    type === 'info' ? 'bg-blue-500' : 
                    'bg-gray-500';
    
    toast.className = `${bgColor} text-white px-6 py-4 rounded-lg shadow-lg font-semibold transform transition-all duration-300 opacity-0 translate-x-full`;
    toast.textContent = message;
    
    const container = document.getElementById('toast-container');
    if (container) {
        container.appendChild(toast);
        
        // Trigger animation
        setTimeout(() => {
            toast.classList.remove('opacity-0', 'translate-x-full');
        }, 10);
        
        // Remove toast after 3 seconds
        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-x-full');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
};

// Smooth scroll to element
window.scrollToElement = function(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};

// Progress Animation on Scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate-fade-in');
        }
    });
}, observerOptions);

// Observe all cards and progress bars
document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.card, [class*="bg-gradient"]');
    elements.forEach(el => observer.observe(el));
});

// Add fade-in animation class
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out forwards;
    }
`;
document.head.appendChild(style);

// AJAX helper function
window.makeRequest = async function(url, method = 'POST', data = {}) {
    try {
        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: method !== 'GET' ? JSON.stringify(data) : undefined
        });
        
        return await response.json();
    } catch (error) {
        console.error('Request failed:', error);
        throw error;
    }
};

// Reading progress tracker
window.markProgress = async function(verseId, type) {
    const routes = {
        'read': window.location.origin + '/verse/' + verseId + '/mark-read',
        'understood': window.location.origin + '/verse/' + verseId + '/mark-understood',
        'memorized': window.location.origin + '/verse/' + verseId + '/mark-memorized'
    };

    const url = routes[type];

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        if (data.success) {
            showToast(data.message, 'success');
            
            // Update points display if available
            const pointsDisplay = document.querySelector('[data-user-points]');
            if (pointsDisplay && data.total_points) {
                pointsDisplay.textContent = data.total_points;
            }
            
            // Reload page after a short delay to show updated progress
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            showToast('Failed to update progress', 'error');
        }
    } catch (error) {
        showToast('An error occurred', 'error');
        console.error('Error:', error);
    }
};

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Alt + D for Dashboard
    if (e.altKey && e.key === 'd') {
        e.preventDefault();
        window.location.href = '/dashboard';
    }
    
    // Alt + V for Vedas
    if (e.altKey && e.key === 'v') {
        e.preventDefault();
        window.location.href = '/vedas';
    }
    
    // Alt + L for Leaderboard
    if (e.altKey && e.key === 'l') {
        e.preventDefault();
        window.location.href = '/leaderboard';
    }
});
