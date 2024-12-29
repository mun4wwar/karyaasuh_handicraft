<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function upload(Request $request)
    {
        // Validasi input
        $request->validate([
            'order_id' => 'required|exists:transactions,order_id',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:7168',
        ]);

        // Temukan transaksi berdasarkan order_id
        $transaction = Transaction::where('order_id', $request->order_id)->first();

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        try {
            if ($request->hasFile('payment_proof')) {
                // Hapus bukti pembayaran lama jika ada
                if ($transaction->payment_proof && Storage::exists('payment_proofs/' . $transaction->payment_proof)) {
                    Storage::delete('payment_proofs/' . $transaction->payment_proof);
                }

                // Simpan bukti pembayaran baru
                $file = $request->file('payment_proof');
                $filename = time() . '_' . $file->getClientOriginalName();

                // Menyimpan file ke storage/payment_proofs
                $file->storeAs('payment_proofs', $filename);
                Log::info('File uploaded to: ' . storage_path('app/payment_proofs/' . $filename));

                // Update data transaksi dengan nama file bukti pembayaran
                $transaction->payment_proof = $filename;
            }

            // Ubah status pembayaran menjadi 'paid'
            $transaction->payment_status = 'paid';
            $transaction->payment_date = now();
            $transaction->save();

            return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah. Mohon tunggu verifikasi.');
        } catch (\Exception $e) {
            // Tangani error yang tidak terduga
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah bukti pembayaran. Silakan coba lagi.');
        }
    }
}
