import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Fungsi Global untuk menampilkan Toast (Notifikasi)
function showToast(message) {
    const toastContainer = document.querySelector('.toast-container');
    if (!toastContainer) return;

    // Pastikan Bootstrap 5 dimuat untuk menggunakan Toast
    if (typeof bootstrap === 'undefined' || !document.getElementById('successToastTemplate')) return;

    const toastElement = document.getElementById('successToastTemplate').cloneNode(true);
    toastElement.removeAttribute('id');
    
    // Ganti pesan default
    toastElement.querySelector('.toast-body').innerHTML = `<i class="fas fa-check-circle me-2"></i> ${message}`;

    toastContainer.appendChild(toastElement);
    const toast = new bootstrap.Toast(toastElement);
    
    // Tampilkan dan hapus elemen setelah selesai
    toastElement.addEventListener('hidden.bs.toast', function () {
        toastElement.remove();
    });
    
    toast.show();
}

// Store keranjang
Alpine.store('cart', {
    items: JSON.parse(localStorage.getItem('vanisha_cart') || '[]'),
    get count() {
        return this.items.reduce((t, i) => t + i.quantity, 0);
    },
    get total() {
        return this.items.reduce((t, i) => t + i.price * i.quantity, 0);
    },
    saveCart() {
        localStorage.setItem('vanisha_cart', JSON.stringify(this.items));
    },
    addToCart(name, price) {
        const existing = this.items.find(i => i.name === name);
        if (existing) {
            existing.quantity++;
        } else {
            this.items.push({ name, price: parseFloat(price), quantity: 1 });
        }
        this.saveCart();
        Alpine.store('ui').cartOpen = true;
        
        // Tampilkan Notifikasi Toast
        showToast('Produk berhasil ditambahkan ke keranjang.');
    },
    removeItem(index) {
        this.items.splice(index, 1);
        this.saveCart();
    },
    
    // ========== PERUBAHAN BARU: FUNGSI +/- ==========
    incrementItem(index) {
        this.items[index].quantity++;
        this.saveCart();
    },
    decrementItem(index) {
        if (this.items[index].quantity > 1) {
            this.items[index].quantity--;
        } else {
            // Jika kuantitas menjadi 0, hapus item
            this.items.splice(index, 1);
        }
        this.saveCart();
    },
    // ===============================================

    formatRupiah(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(value);
    },
    
    checkoutToPayment() {
        if (this.items.length === 0) {
            alert('Keranjang belanja kosong. Silakan tambahkan produk terlebih dahulu.');
            return;
        }
        
        alert('Anda akan diarahkan ke halaman Checkout untuk memilih metode pembayaran (Dana, BCA, dll.).');
        // PASTIKAN ROUTE /checkout SUDAH DIDAFTARKAN DI LARAVEL
        window.location.href = '/checkout'; 
    },
    
    checkoutWhatsapp() {
        if (this.items.length === 0) {
            alert('Keranjang belanja kosong. Silakan tambahkan produk terlebih dahulu.');
            return;
        }

        const totalFormatted = this.formatRupiah(this.total);
        const itemsList = this.items.map(item => `- ${item.name} (x${item.quantity}) - ${this.formatRupiah(item.price * item.quantity)}`).join('\n');
        
        const message = 
`--- Pesanan Vanisha Bakery ---
Halo Vanisha Bakery! Saya ingin memesan produk berikut:

${itemsList}

Total Pembayaran: ${totalFormatted}

Mohon konfirmasi pesanan saya. Terima kasih.`;

        const whatsappNumber = '089675266954'; 
        const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`; 
        
        alert('Anda akan diarahkan ke WhatsApp untuk konfirmasi pesanan.');
        window.open(whatsappUrl, '_blank');

        this.items = [];
        this.saveCart();
        Alpine.store('ui').cartOpen = false;
    }
});

// Store UI
Alpine.store('ui', {
    navOpen: false, // Untuk mobile navbar
    cartOpen: false
});

Alpine.start();

// ... (Kode ANIMASI TYPING tetap sama)
document.addEventListener('DOMContentLoaded', () => {
    // ... (Kode animasi typing tetap di sini)
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

    const typeSpeed = 80;    // kecepatan ketik
    const pauseDelay = 1500; // jeda setelah kalimat selesai

    function typeLoop() {
        const current = texts[textIndex];

        if (typing) {
            charIndex++;
            el.textContent = current.substring(0, charIndex);

            if (charIndex === current.length) {
                typing = false;
                setTimeout(typeLoop, pauseDelay);
            } else {
                setTimeout(typeLoop, typeSpeed);
            }
        } else {
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

    el.textContent = '';
    typeLoop();
});