<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futsal Reservasi - Platform Pemesanan Lapangan Futsal Terpercaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i class="fas fa-futbol text-2xl text-blue-600"></i>
                <h1 class="text-2xl font-bold text-gray-800">Futsal Reservasi</h1>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-gray-700 font-semibold">{{ Auth::user()->name }}</span>
                    @if(Auth::user()->role === 'super_admin')
                        <a href="{{ route('superadmin.dashboard') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                            <i class="fas fa-crown mr-2"></i>Dashboard Super Admin
                        </a>
                    @elseif(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                            <i class="fas fa-cog mr-2"></i>Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('customer.dashboard') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-home mr-2"></i>Dashboard
                        </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-blue-600 border-2 border-blue-600 rounded-lg hover:bg-blue-50 transition font-semibold">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-user-plus mr-2"></i>Daftar
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <i class="fas fa-futbol text-6xl mb-6 block"></i>
            <h1 class="text-5xl font-bold mb-6">Pesan Lapangan Futsal Dengan Mudah</h1>
            <p class="text-xl mb-8 opacity-90">Platform terpercaya untuk pemesanan lapangan futsal. Cepat, aman, dan terjangkau.</p>
            <div class="space-x-4">
                @auth
                    @if(Auth::user()->role === 'user')
                        <a href="{{ route('customer.fields') }}" class="inline-block px-8 py-3 bg-white text-blue-600 font-bold rounded-lg hover:bg-gray-100 transition">
                            <i class="fas fa-search mr-2"></i>Lihat Lapangan
                        </a>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="inline-block px-8 py-3 bg-white text-blue-600 font-bold rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-user-plus mr-2"></i>Daftar Gratis
                    </a>
                    <a href="{{ route('login') }}" class="inline-block px-8 py-3 border-2 border-white text-white font-bold rounded-lg hover:bg-white hover:text-blue-600 transition">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-16 text-gray-800">Keunggulan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="card-hover bg-white p-8 rounded-lg shadow-lg">
                    <i class="fas fa-clock text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Booking Cepat</h3>
                    <p class="text-gray-600">Pesan lapangan dalam hitungan menit dengan sistem yang user-friendly dan responsif.</p>
                </div>

                <!-- Feature 2 -->
                <div class="card-hover bg-white p-8 rounded-lg shadow-lg">
                    <i class="fas fa-lock text-4xl text-green-600 mb-4"></i>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Aman & Terpercaya</h3>
                    <p class="text-gray-600">Sistem keamanan berlapis dan verifikasi pembayaran yang ketat untuk perlindungan maksimal.</p>
                </div>

                <!-- Feature 3 -->
                <div class="card-hover bg-white p-8 rounded-lg shadow-lg">
                    <i class="fas fa-tags text-4xl text-yellow-600 mb-4"></i>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Harga Kompetitif</h3>
                    <p class="text-gray-600">Dapatkan harga terbaik dengan berbagai paket dan penawaran menarik sepanjang tahun.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-20 bg-blue-50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-16 text-gray-800">Cara Menggunakan</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="bg-blue-600 text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 text-2xl font-bold">1</div>
                    <h3 class="font-bold text-gray-800 mb-2">Daftar</h3>
                    <p class="text-gray-600 text-sm">Buat akun dengan mudah menggunakan email Anda</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-600 text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 text-2xl font-bold">2</div>
                    <h3 class="font-bold text-gray-800 mb-2">Pilih Lapangan</h3>
                    <p class="text-gray-600 text-sm">Lihat dan pilih lapangan favorit Anda</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-600 text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 text-2xl font-bold">3</div>
                    <h3 class="font-bold text-gray-800 mb-2">Pesan & Bayar</h3>
                    <p class="text-gray-600 text-sm">Pesan jam yang Anda inginkan dan lakukan pembayaran</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-600 text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 text-2xl font-bold">4</div>
                    <h3 class="font-bold text-gray-800 mb-2">Main Futsal!</h3>
                    <p class="text-gray-600 text-sm">Datang dan nikmati permainan futsal Anda</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-16 text-gray-800">Kepuasan Pelanggan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow card-hover">
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 mb-4">"Sangat mudah dan cepat! Saya bisa pesan lapangan hanya dalam 2 menit."</p>
                    <p class="font-bold text-gray-800">Budi Santoso</p>
                    <p class="text-sm text-gray-500">Jakarta</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow card-hover">
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 mb-4">"Platform yang terpercaya dan harga yang sangat kompetitif. Recommended!"</p>
                    <p class="font-bold text-gray-800">Siti Nurhaliza</p>
                    <p class="text-sm text-gray-500">Bandung</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow card-hover">
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 mb-4">"Layanan pelanggan yang responsif dan profesional. Sangat puas!"</p>
                    <p class="font-bold text-gray-800">Ahmad Wijaya</p>
                    <p class="text-sm text-gray-500">Surabaya</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="hero-gradient text-white py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Siap Bermain Futsal?</h2>
            <p class="text-lg mb-8 opacity-90">Bergabunglah dengan ribuan pengguna yang sudah mempercayai kami</p>
            <div class="space-x-4">
                @auth
                    @if(Auth::user()->role === 'user')
                        <a href="{{ route('customer.fields') }}" class="inline-block px-8 py-3 bg-white text-blue-600 font-bold rounded-lg hover:bg-gray-100 transition">
                            <i class="fas fa-check mr-2"></i>Mulai Pesan
                        </a>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="inline-block px-8 py-3 bg-white text-blue-600 font-bold rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-user-plus mr-2"></i>Daftar Gratis
                    </a>
                    <a href="{{ route('login') }}" class="inline-block px-8 py-3 border-2 border-white text-white font-bold rounded-lg hover:bg-white hover:text-blue-600 transition">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <i class="fas fa-futbol mr-2"></i>Futsal Reservasi
                    </h3>
                    <p class="text-gray-400">Platform pemesanan lapangan futsal terpercaya dengan ribuan pengguna aktif.</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Layanan</h3>
                    <ul class="text-gray-400 space-y-2">
                        <li><a href="#" class="hover:text-white transition">Pesan Lapangan</a></li>
                        <li><a href="#" class="hover:text-white transition">Riwayat Booking</a></li>
                        <li><a href="#" class="hover:text-white transition">Notifikasi</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Bantuan</h3>
                    <ul class="text-gray-400 space-y-2">
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition">Hubungi Kami</a></li>
                        <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Kontak</h3>
                    <p class="text-gray-400">📧 info@futsalreservasi.com</p>
                    <p class="text-gray-400">📱 +62 812 3456 7890</p>
                </div>
            </div>
            <hr class="border-gray-700 mb-8">
            <div class="text-center text-gray-400">
                <p>&copy; 2025 Futsal Reservasi. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>
</body>
</html>
