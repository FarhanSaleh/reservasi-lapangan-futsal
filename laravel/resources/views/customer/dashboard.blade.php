@extends('layouts.customer')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Pelanggan')

@section('content')
<div class="dashboard">
    <div class="stats-grid">
        <div class="stat-card">
            <h3>📊 Total Booking</h3>
            <p class="stat-value">{{ $stats['total_bookings'] ?? 0 }}</p>
            <a href="{{ route('customer.booking-history') }}" class="btn btn-small btn-primary">Lihat Detail</a>
        </div>
        <div class="stat-card">
            <h3>⏳ Booking Pending</h3>
            <p class="stat-value">{{ $stats['pending_bookings'] ?? 0 }}</p>
            <small>Menunggu verifikasi admin</small>
        </div>
        <div class="stat-card">
            <h3>✅ Booking Dikonfirmasi</h3>
            <p class="stat-value">{{ $stats['confirmed_bookings'] ?? 0 }}</p>
            <small>Siap digunakan</small>
        </div>
        <div class="stat-card">
            <h3>🔔 Notifikasi Baru</h3>
            <p class="stat-value">{{ $stats['unread_notifications'] ?? 0 }}</p>
            <a href="{{ route('customer.notifications') }}" class="btn btn-small btn-primary">Lihat Notifikasi</a>
        </div>
    </div>

    <!-- Recent Bookings Section -->
    <div class="recent-bookings">
        <h3>📅 Booking Terbaru</h3>
        @if(isset($recentBookings) && $recentBookings->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Lapangan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentBookings as $booking)
                        <tr>
                            <td><strong>{{ $booking->field->name ?? 'N/A' }}</strong></td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                            <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                            <td><span class="badge badge-{{ strtolower($booking->status) }}">{{ ucfirst($booking->status) }}</span></td>
                            <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('customer.field-details', $booking->field_id) }}" class="btn btn-small btn-secondary">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="padding: 2rem; text-align: center; background: #f8f9fa; border-radius: 8px;">
                <p style="color: #666; margin-bottom: 1rem;">Belum ada booking. Mulai booking sekarang!</p>
                <a href="{{ route('customer.fields') }}" class="btn btn-primary">Lihat Lapangan Tersedia</a>
            </div>
        @endif
    </div>

    <!-- Quick Actions -->
    <div class="card" style="margin-top: 2rem;">
        <h3>🚀 Aksi Cepat</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
            <a href="{{ route('customer.fields') }}" class="btn btn-primary" style="text-align: center; padding: 1.5rem;">
                📅 Booking Lapangan
            </a>
            <a href="{{ route('customer.booking-history') }}" class="btn btn-secondary" style="text-align: center; padding: 1.5rem;">
                📋 Riwayat Booking
            </a>
            <a href="{{ route('customer.notifications') }}" class="btn btn-secondary" style="text-align: center; padding: 1.5rem;">
                🔔 Notifikasi
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger" style="text-align: center; padding: 1.5rem;">
                🚪 Logout
            </a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Information Section -->
    <div class="card" style="margin-top: 2rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        <h3 style="color: white;">ℹ️ Informasi Penting</h3>
        <ul style="margin-left: 1.5rem; color: white;">
            <li>Lakukan pembayaran sebelum batas waktu untuk mengamankan booking Anda</li>
            <li>Upload bukti pembayaran dengan jelas untuk memudahkan verifikasi admin</li>
            <li>Cek notifikasi secara berkala untuk update status booking Anda</li>
            <li>Hubungi admin jika ada pertanyaan atau kendala</li>
        </ul>
    </div>
</div>
@endsection
                </thead>
                <tbody>
                    @foreach($recentBookings as $booking)
                    <tr>
                        <td>{{ $booking->field->name }}</td>
                        <td>{{ $booking->booking_date->format('M d, Y') }}</td>
                        <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                        <td><span class="badge badge-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
                        <td>Rp {{ number_format($booking->total_price, 2) }}</td>
                        <td><a href="{{ route('customer.booking-history') }}">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No bookings yet. <a href="{{ route('customer.fields') }}">Book a field now!</a></p>
        @endif
    </div>
</div>
@endsection
