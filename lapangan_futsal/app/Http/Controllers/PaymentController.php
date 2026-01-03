<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function getPaymentMethod()
    {
        return collect([['name' => 'bank_transfer'], ['name' => 'cash']])
            ->map(fn($item) => (object)$item);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required|in:bank_transfer,cash',
            'amount' => 'required',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $path = $file->store('photos', 'public');
        }

        Payment::create([
            'payment_method' => $request->payment_method,
            'payment_date' => now(),
            'amount' => $request->amount,
            'payment_proof' => $path,
            'reservation_id' => $id,
        ]);
        catat_log('create', 'Membuat pembayaran');
        return redirect()->back()->with('success', 'Pembayaran berhasil dibuat.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, string $reservationId, string $paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        $reservation = Reservation::findOrFail($reservationId);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:success,pending,failed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $payment->update([
            'status' => $request->status,
        ]);

        if ($request->status == 'success') {
            $reservation->update([
                'status' => 'paid',
            ]);
        }

        if ($request->status == 'pending') {
            $reservation->update([
                'status' => 'pending',
            ]);
        }

        if ($request->status == 'failed') {
            $reservation->update([
                'status' => 'pending',
            ]);
        }

        catat_log('update', 'Mengubah status pembayaran');
        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
