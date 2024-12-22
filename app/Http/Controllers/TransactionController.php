<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Transaction;
use App\Models\Order;

class TransactionController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:transactions,order_id',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        // Temukan transaksi berdasarkan order_id
        $transaction = Transaction::where('order_id', $request->order_id)->first();

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        if ($request->hasFile('payment_proof')) {
            // Hapus bukti pembayaran lama jika ada
            if ($transaction->payment_proof) {
                Storage::delete('public/payment_proofs/' . $transaction->payment_proof);
            }

            // Simpan bukti pembayaran baru
            $filename = time() . '_' . $request->file('payment_proof')->getClientOriginalName();
            $request->file('payment_proof')->storeAs('public/payment_proofs', $filename);

            $transaction->payment_proof = $filename;
        }

        // Ubah status pembayaran
        $transaction->payment_status = 'paid';
        $transaction->save();

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah. Mohon tunggu verifikasi.');
    }
}
