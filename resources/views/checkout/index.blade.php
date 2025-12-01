@extends('layouts.public')

@section('title', 'Checkout - Vanisha Bakery')

@section('content')

<section style="padding: 80px 0; background: #f3f4f6; min-height: calc(100vh - 140px);">
    <div style="max-width: 1000px; margin: 0 auto; padding: 0 16px;">
        
        {{-- Header --}}
        <div style="background: white; border-radius: 16px; padding: 24px; margin-bottom: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
            <h1 style="font-size: 28px; font-weight: 700; color: #b91c1c; margin: 0; display: flex; align-items: center; gap: 12px;">
                <i class="fas fa-truck" style="font-size: 32px;"></i>
                Konfirmasi Checkout
            </h1>
            <p style="font-size: 15px; color: #6b7280; margin: 8px 0 0 0;">
                Selamat, <strong>{{ Auth::user()->name ?? 'Pelanggan' }}</strong>! Anda berhasil masuk ke halaman pembayaran.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr; gap: 24px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
                
                {{-- Form Pengiriman --}}
                <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    <h2 style="font-size: 20px; font-weight: 700; color: #b91c1c; margin: 0 0 20px 0; border-bottom: 2px solid #b91c1c; padding-bottom: 10px;">
                        <i class="fas fa-map-marker-alt" style="margin-right: 8px;"></i>
                        Informasi Pengiriman
                    </h2>
                    
                    <form id="checkoutForm" x-data="checkoutData()" @submit.prevent="submitOrder">
                        <div style="display: flex; flex-direction: column; gap: 16px;">
                            
                            {{-- Nama Penerima --}}
                            <div>
                                <label style="display: block; font-size: 14px; font-weight: 600; margin-bottom: 6px; color: #374151;">
                                    Nama Penerima <span style="color: #b91c1c;">*</span>
                                </label>
                                <input type="text" 
                                       x-model="form.recipient_name"
                                       required
                                       placeholder="Masukkan nama penerima"
                                       style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; transition: border-color 0.2s;"
                                       onfocus="this.style.borderColor='#f97316'" 
                                       onblur="this.style.borderColor='#d1d5db'">
                            </div>

                            {{-- Nomor Telepon --}}
                            <div>
                                <label style="display: block; font-size: 14px; font-weight: 600; margin-bottom: 6px; color: #374151;">
                                    Nomor Telepon <span style="color: #b91c1c;">*</span>
                                </label>
                                <input type="tel" 
                                       x-model="form.phone"
                                       required
                                       placeholder="08xxxxxxxxxx"
                                       pattern="[0-9]{10,13}"
                                       style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; transition: border-color 0.2s;"
                                       onfocus="this.style.borderColor='#f97316'" 
                                       onblur="this.style.borderColor='#d1d5db'">
                            </div>

                            {{-- Provinsi --}}
                            <div>
                                <label style="display: block; font-size: 14px; font-weight: 600; margin-bottom: 6px; color: #374151;">
                                    Provinsi <span style="color: #b91c1c;">*</span>
                                </label>
                                <select x-model="form.province"
                                        required
                                        style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; transition: border-color 0.2s; background: white;"
                                        onfocus="this.style.borderColor='#f97316'" 
                                        onblur="this.style.borderColor='#d1d5db'">
                                    <option value="">Pilih Provinsi</option>
                                    <option value="DKI Jakarta">DKI Jakarta</option>
                                    <option value="Jawa Barat">Jawa Barat</option>
                                    <option value="Jawa Tengah">Jawa Tengah</option>
                                    <option value="Jawa Timur">Jawa Timur</option>
                                    <option value="Banten">Banten</option>
                                    <option value="Yogyakarta">D.I. Yogyakarta</option>
                                </select>
                            </div>

                            {{-- Kota/Kabupaten --}}
                            <div>
                                <label style="display: block; font-size: 14px; font-weight: 600; margin-bottom: 6px; color: #374151;">
                                    Kota/Kabupaten <span style="color: #b91c1c;">*</span>
                                </label>
                                <input type="text" 
                                       x-model="form.city"
                                       required
                                       placeholder="Contoh: Jakarta Selatan"
                                       style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; transition: border-color 0.2s;"
                                       onfocus="this.style.borderColor='#f97316'" 
                                       onblur="this.style.borderColor='#d1d5db'">
                            </div>

                            {{-- Kecamatan --}}
                            <div>
                                <label style="display: block; font-size: 14px; font-weight: 600; margin-bottom: 6px; color: #374151;">
                                    Kecamatan <span style="color: #b91c1c;">*</span>
                                </label>
                                <input type="text" 
                                       x-model="form.district"
                                       required
                                       placeholder="Contoh: Kebayoran Baru"
                                       style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; transition: border-color 0.2s;"
                                       onfocus="this.style.borderColor='#f97316'" 
                                       onblur="this.style.borderColor='#d1d5db'">
                            </div>

                            {{-- Kode Pos --}}
                            <div>
                                <label style="display: block; font-size: 14px; font-weight: 600; margin-bottom: 6px; color: #374151;">
                                    Kode Pos <span style="color: #b91c1c;">*</span>
                                </label>
                                <input type="text" 
                                       x-model="form.postal_code"
                                       required
                                       placeholder="12345"
                                       pattern="[0-9]{5}"
                                       maxlength="5"
                                       style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; transition: border-color 0.2s;"
                                       onfocus="this.style.borderColor='#f97316'" 
                                       onblur="this.style.borderColor='#d1d5db'">
                            </div>

                            {{-- Alamat Lengkap --}}
                            <div>
                                <label style="display: block; font-size: 14px; font-weight: 600; margin-bottom: 6px; color: #374151;">
                                    Alamat Lengkap <span style="color: #b91c1c;">*</span>
                                </label>
                                <textarea x-model="form.address"
                                          required
                                          rows="3"
                                          placeholder="Jalan, Nomor Rumah/Gedung, RT/RW, dll"
                                          style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; resize: vertical; transition: border-color 0.2s;"
                                          onfocus="this.style.borderColor='#f97316'" 
                                          onblur="this.style.borderColor='#d1d5db'"></textarea>
                            </div>

                            {{-- Catatan --}}
                            <div>
                                <label style="display: block; font-size: 14px; font-weight: 600; margin-bottom: 6px; color: #374151;">
                                    Catatan (Opsional)
                                </label>
                                <textarea x-model="form.notes"
                                          rows="2"
                                          placeholder="Catatan untuk kurir atau toko"
                                          style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; resize: vertical; transition: border-color 0.2s;"
                                          onfocus="this.style.borderColor='#f97316'" 
                                          onblur="this.style.borderColor='#d1d5db'"></textarea>
                            </div>

                        </div>
                    </form>
                </div>

                {{-- Ringkasan Pesanan --}}
                <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); height: fit-content;" x-data>
                    <h2 style="font-size: 20px; font-weight: 700; color: #b91c1c; margin: 0 0 20px 0; border-bottom: 2px solid #b91c1c; padding-bottom: 10px;">
                        <i class="fas fa-shopping-bag" style="margin-right: 8px;"></i>
                        Ringkasan Pesanan
                    </h2>

                    <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 20px;">
                        <template x-for="(item, index) in $store.cart.items" :key="index">
                            <div style="display: flex; justify-content: space-between; padding: 12px; background: #fef7ec; border-radius: 8px;">
                                <div style="flex: 1;">
                                    <p style="font-weight: 600; font-size: 14px; margin: 0 0 4px 0;" x-text="item.name"></p>
                                    <p style="font-size: 13px; color: #6b7280; margin: 0;" x-text="$store.cart.formatRupiah(item.price) + ' × ' + item.quantity"></p>
                                </div>
                                <p style="font-weight: 700; font-size: 14px; color: #b91c1c; margin: 0;" x-text="$store.cart.formatRupiah(item.price * item.quantity)"></p>
                            </div>
                        </template>
                    </div>

                    <div style="border-top: 2px solid #e5e7eb; padding-top: 16px; margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="font-size: 14px; color: #6b7280;">Subtotal</span>
                            <span style="font-size: 14px; font-weight: 600;" x-text="$store.cart.formatRupiah($store.cart.total)"></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="font-size: 14px; color: #6b7280;">Ongkir</span>
                            <span style="font-size: 14px; font-weight: 600; color: #10b981;">Gratis</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding-top: 12px; border-top: 1px solid #e5e7eb;">
                            <span style="font-size: 16px; font-weight: 700;">Total</span>
                            <span style="font-size: 20px; font-weight: 800; color: #b91c1c;" x-text="$store.cart.formatRupiah($store.cart.total)"></span>
                        </div>
                    </div>

                    {{-- Metode Pembayaran --}}
                    <div style="margin-bottom: 20px;">
                        <h3 style="font-size: 16px; font-weight: 700; margin: 0 0 12px 0; color: #374151;">
                            Metode Pembayaran
                        </h3>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label style="display: flex; align-items: center; padding: 10px; border: 2px solid #d1d5db; border-radius: 8px; cursor: pointer; transition: all 0.2s;"
                                   onmouseover="this.style.borderColor='#f97316'" 
                                   onmouseout="this.querySelector('input:checked') ? this.style.borderColor='#f97316' : this.style.borderColor='#d1d5db'">
                                <input type="radio" name="payment_method" value="transfer" checked style="margin-right: 10px; accent-color: #f97316;">
                                <div>
                                    <p style="font-weight: 600; font-size: 14px; margin: 0;">Transfer Bank</p>
                                    <p style="font-size: 12px; color: #6b7280; margin: 0;">BCA, BNI, Mandiri</p>
                                </div>
                            </label>
                            <label style="display: flex; align-items: center; padding: 10px; border: 2px solid #d1d5db; border-radius: 8px; cursor: pointer; transition: all 0.2s;"
                                   onmouseover="this.style.borderColor='#f97316'" 
                                   onmouseout="this.querySelector('input:checked') ? this.style.borderColor='#f97316' : this.style.borderColor='#d1d5db'">
                                <input type="radio" name="payment_method" value="cod" style="margin-right: 10px; accent-color: #f97316;">
                                <div>
                                    <p style="font-weight: 600; font-size: 14px; margin: 0;">Bayar di Tempat (COD)</p>
                                    <p style="font-size: 12px; color: #6b7280; margin: 0;">Cash On Delivery</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Tombol Proses --}}
                    <button form="checkoutForm" type="submit"
                            style="width: 100%; padding: 14px; background: #f97316; color: white; border: none; border-radius: 999px; font-size: 15px; font-weight: 700; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);"
                            onmouseover="this.style.background='#ea580c'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(249, 115, 22, 0.4)'"
                            onmouseout="this.style.background='#f97316'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(249, 115, 22, 0.3)'">
                        <i class="fas fa-check-circle" style="margin-right: 8px;"></i>
                        Proses Pesanan
                    </button>

                    <a href="{{ url('/') }}" 
                       style="display: block; text-align: center; margin-top: 12px; color: #6b7280; font-size: 14px; text-decoration: none; transition: color 0.2s;"
                       onmouseover="this.style.color='#f97316'"
                       onmouseout="this.style.color='#6b7280'">
                        <i class="fas fa-arrow-left" style="margin-right: 6px;"></i>
                        Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>

        {{-- Info Box --}}
        <div style="background: #fef7ec; border-left: 4px solid #f97316; padding: 16px 20px; border-radius: 8px; margin-top: 24px;">
            <h3 style="font-size: 16px; font-weight: 700; color: #f97316; margin: 0 0 8px 0;">
                Langkah Selanjutnya:
            </h3>
            <ol style="margin: 0; padding-left: 20px; line-height: 1.8; color: #374151;">
                <li><strong>Review Pesanan:</strong> Tampilkan daftar produk dan total akhir.</li>
                <li><strong>Alamat Pengiriman:</strong> Konfirmasi atau masukkan alamat Anda.</li>
                <li><strong>Metode Pembayaran:</strong> Pilih metode yang Anda inginkan (misal: Transfer Bank, E-Wallet).</li>
            </ol>
            <p style="margin: 12px 0 0 0; font-size: 13px; color: #6b7280; font-style: italic;">
                Saat ini, halaman ini hanya sebagai <strong>placeholder</strong>. Implementasi formulir akan dilakukan di sini.
            </p>
        </div>

    </div>
</section>

<script>
function checkoutData() {
    return {
        form: {
            recipient_name: '',
            phone: '',
            province: '',
            city: '',
            district: '',
            postal_code: '',
            address: '',
            notes: ''
        },
        
        submitOrder() {
            // Validasi form
            if (!this.form.recipient_name || !this.form.phone || !this.form.province || 
                !this.form.city || !this.form.district || !this.form.postal_code || !this.form.address) {
                alert('Harap lengkapi semua field yang wajib diisi!');
                return;
            }

            // Get payment method
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            
            // Get cart items
            const cartItems = Alpine.store('cart').items;
            const total = Alpine.store('cart').total;

            // Prepare order data
            const orderData = {
                ...this.form,
                payment_method: paymentMethod,
                items: cartItems,
                total: total
            };

            console.log('Order Data:', orderData);

            // Simulasi sukses (nanti ganti dengan AJAX ke backend)
            alert('Pesanan berhasil diproses!\n\nNama: ' + this.form.recipient_name + '\nTotal: Rp' + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
            
            // Clear cart
            Alpine.store('cart').items = [];
            Alpine.store('cart').save();
            Alpine.store('cart').updateBadge();
            
            // Redirect
            window.location.href = '{{ url("/") }}';
        }
    }
}
</script>

@endsection
