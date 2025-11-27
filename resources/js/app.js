import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Store keranjang
Alpine.store('cart', {
    items: [],
    get count() {
        return this.items.reduce((t, i) => t + i.quantity, 0);
    },
    get total() {
        return this.items.reduce((t, i) => t + i.price * i.quantity, 0);
    },
    addToCart(name, price) {
        const existing = this.items.find(i => i.name === name);
        if (existing) {
            existing.quantity++;
        } else {
            this.items.push({ name, price, quantity: 1 });
        }
    },
    removeItem(index) {
        this.items.splice(index, 1);
    },
    formatRupiah(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(value);
    },
    checkout() {
        alert('Terima kasih, pesanan akan diproses!');
        this.items = [];
    }
});

// Store UI
Alpine.store('ui', {
    navOpen: false,
    cartOpen: false
});

Alpine.start();

/**
 * ANIMASI TYPING UNTUK TEKS HERO
 * Mengetik 3 kalimat bergantian tanpa kursor.
 */
document.addEventListener('DOMContentLoaded', () => {
    const el = document.getElementById('hero-typing-text');
    if (!el) return;

    const texts = [
        'Rasakan kelezatan roti dan kue buatan kami.',
        'Roti enak, kue lezat, setiap hari untuk Anda.',
        'Nikmati roti hangat dengan berbagai varian rasa.'
    ];

    let textIndex = 0;
    let charIndex = 0;
    let typing = true;

    const typeSpeed = 80;    // kecepatan ketik
    const pauseDelay = 1500; // jeda setelah kalimat selesai

    function typeLoop() {
        const current = texts[textIndex];

        if (typing) {
            // tambahkan karakter
            charIndex++;
            el.textContent = current.substring(0, charIndex);

            if (charIndex === current.length) {
                typing = false;
                setTimeout(typeLoop, pauseDelay);
            } else {
                setTimeout(typeLoop, typeSpeed);
            }
        } else {
            // hapus karakter
            charIndex--;
            el.textContent = current.substring(0, charIndex);

            if (charIndex === 0) {
                typing = true;
                textIndex = (textIndex + 1) % texts.length;
                setTimeout(typeLoop, typeSpeed);
            } else {
                setTimeout(typeLoop, typeSpeed / 2);
            }
        }
    }

    // mulai animasi
    el.textContent = '';
    typeLoop();
});
