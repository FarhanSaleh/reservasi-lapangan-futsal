<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Lapangan Futsal - Platform Terpercaya</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .hero-buttons .btn {
            font-size: 1.1rem;
            padding: 1rem 2rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-brand">
            <h1>⚽ FUTSAL RESERVASI</h1>
        </div>
        <ul class="navbar-menu">
            <li><a href="#fitur">Fitur</a></li>
            <li><a href="#tentang">Tentang</a></li>
            <li><a href="{{ route('login') }}" class="btn btn-primary">Login</a></li>
            <li><a href="{{ route('register') }}" class="btn btn-secondary">Daftar</a></li>
        </ul>
    </nav>

    <div class="container">
        <!-- Hero Section -->
        <section class="hero">
            <h1>Reservasi Lapangan Futsal dengan Mudah</h1>
            <p>Platform booking lapangan futsal terpercaya dan terintegrasi dengan sistem pembayaran online</p>
            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary btn-large">Masuk Sekarang</a>
                <a href="{{ route('register') }}" class="btn btn-secondary btn-large">Daftar Gratis</a>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features" id="fitur">
            <h2>Fitur Unggulan</h2>
            <div class="features-grid">
                <div class="feature">
                    <h3>📅 Booking Mudah</h3>
                    <p>Pilih lapangan dan waktu dengan interface yang user-friendly dan real-time availability</p>
                </div>
                <div class="feature">
                    <h3>💳 Pembayaran Aman</h3>
                    <p>Sistem pembayaran terintegrasi dengan upload bukti transfer yang aman dan terverifikasi</p>
                </div>
                <div class="feature">
                    <h3>📊 Dashboard Real-time</h3>
                    <p>Pantau status booking, pembayaran, dan notifikasi real-time dalam satu dashboard</p>
                </div>
                <div class="feature">
                    <h3>👥 Multi-Role Access</h3>
                    <p>Akses berbeda untuk Customer, Admin, dan Super Admin dengan kontrol penuh</p>
                </div>
                <div class="feature">
                    <h3>📱 Mobile Friendly</h3>
                    <p>Responsive design yang sempurna di semua perangkat desktop, tablet, dan mobile</p>
                </div>
                <div class="feature">
                    <h3>📈 Laporan Lengkap</h3>
                    <p>Laporan detail revenue, transaksi, dan penggunaan lapangan untuk analisis bisnis</p>
                </div>
            </div>
        </section>

        <!-- Info Section -->
        <section style="background: white; padding: 2rem; border-radius: 8px; margin-bottom: 3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);" id="tentang">
            <h2 style="margin-bottom: 1rem; color: #333;">Tentang Platform Kami</h2>
            <p style="margin-bottom: 1rem; color: #666; line-height: 1.8;">
                <strong>Sistem Reservasi Lapangan Futsal</strong> adalah platform modern yang dirancang untuk memudahkan proses penjadwalan dan pemesanan lapangan futsal. 
                Dengan antarmuka yang intuitif dan fitur-fitur lengkap, kami membantu pengelola lapangan dalam mengelola booking dan pembayaran secara efisien.
            </p>
            
            <div class="stats-grid" style="margin-top: 2rem;">
                <div class="stat-card">
                    <h3>✓ Aman & Terpercaya</h3>
                    <p style="color: #666; margin-top: 0.5rem;">Sistem keamanan berlapis dengan enkripsi data dan verifikasi pembayaran</p>
                </div>
                <div class="stat-card">
                    <h3>⚡ Cepat & Efisien</h3>
                    <p style="color: #666; margin-top: 0.5rem;">Proses booking dan verifikasi yang cepat hanya dalam hitungan menit</p>
                </div>
                <div class="stat-card">
                    <h3>🎯 Fitur Lengkap</h3>
                    <p style="color: #666; margin-top: 0.5rem;">Dari booking hingga laporan, semua tersedia dalam satu platform</p>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem; border-radius: 8px; text-align: center; margin-bottom: 3rem;">
            <h2 style="margin-bottom: 1rem;">Siap untuk Mulai?</h2>
            <p style="margin-bottom: 1.5rem; font-size: 1.1rem;">Daftarkan akun Anda sekarang dan nikmati kemudahan booking lapangan futsal</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-large" style="background: white; color: #667eea;">Daftar Sekarang</a>
        </section>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Sistem Reservasi Lapangan Futsal. Semua hak dilindungi.</p>
        <p style="margin-top: 0.5rem; font-size: 0.9rem;">Hubungi kami: info@futsal-reservasi.com | +62-XXX-XXX-XXX</p>
    </footer>
</body>
</html>
