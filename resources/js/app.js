import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// ========================================
// CSRF TOKEN REFRESH
// ========================================
setInterval(function() {
    fetch('/csrf-token-refresh')
        .then(response => response.json())
        .then(data => {
            document.querySelector('meta[name="csrf-token"]').setAttribute('content', data.token);
        })
        .catch(error => console.log('CSRF refresh error:', error));
}, 3600000);

// ========================================
// DROPDOWN USER FUNCTIONALITY
// ========================================
window.toggleDropdown = function() {
    const dropdown = document.getElementById('userDropdown');
    const icon = document.getElementById('dropdownIcon');
    
    if (dropdown && icon) {
        dropdown.classList.toggle('show');
        icon.style.transform = dropdown.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0deg)';
    }
};

document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('userDropdown');
    
    if (dropdown && !event.target.closest('.user-dropdown')) {
        dropdown.classList.remove('show');
        const icon = document.getElementById('dropdownIcon');
        if (icon) icon.style.transform = 'rotate(0deg)';
    }
});

// ========================================
// MOBILE MENU FUNCTIONALITY
// ========================================
window.toggleMobileMenu = function() {
    const menu = document.getElementById('mobileMenu');
    const icon = document.getElementById('menuIcon');
    
    if (menu && icon) {
        menu.classList.toggle('open');
        icon.className = menu.classList.contains('open') ? 'fas fa-times' : 'fas fa-bars';
    }
};

window.closeMobileMenu = function() {
    const menu = document.getElementById('mobileMenu');
    const icon = document.getElementById('menuIcon');
    
    if (menu && icon) {
        menu.classList.remove('open');
        icon.className = 'fas fa-bars';
    }
};

window.addEventListener('resize', function() {
    if (window.innerWidth >= 768) {
        const menu = document.getElementById('mobileMenu');
        const icon = document.getElementById('menuIcon');
        
        if (menu && icon) {
            menu.classList.remove('open');
            icon.className = 'fas fa-bars';
        }
    }
});

// ========================================
// TEXT ROTATOR - Hero Section
// ========================================
document.addEventListener('DOMContentLoaded', function() {
    const textElement = document.getElementById('hero-typing-text');
    
    if (textElement) {
        const texts = [
            'Rasakan kelezatan roti dan kue buatan kami.',
            'Dipanggang segar setiap pagi untuk Anda.',
            'Nikmati cita rasa tradisional yang autentik.'
        ];
        
        let index = 0;
        
        // Typing animation pertama kali
        const firstText = texts[0];
        let i = 0;
        function typeFirstText() {
            if (i < firstText.length) {
                textElement.textContent += firstText.charAt(i);
                i++;
                setTimeout(typeFirstText, 50);
            } else {
                // Setelah typing selesai, mulai interval ganti teks
                setTimeout(() => {
                    setInterval(function() {
                        textElement.style.opacity = '0';
                        
                        setTimeout(function() {
                            index = (index + 1) % texts.length;
                            textElement.textContent = texts[index];
                            textElement.style.opacity = '1';
                        }, 500);
                    }, 4000);
                }, 2000);
            }
        }
        
        textElement.textContent = "";
        textElement.style.transition = 'opacity 0.5s ease';
        typeFirstText();
    }
});
