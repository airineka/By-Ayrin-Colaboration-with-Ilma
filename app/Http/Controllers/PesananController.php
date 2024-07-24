<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PesananController extends Controller
{
    use AuthorizesRequests;

    // Tampilkan semua pesanan milik user yang sedang login
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            Log::info('User ID: ' . $user->id);
            $pesanans = $user->pesanans;
            Log::info('Pesanan Count: ' . $pesanans->count());
            return view('pesanan.index', compact('pesanans'));
        } else {
            Log::error('User is not authenticated.');
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }
    }

    // Tampilkan form untuk membuat pesanan baru
    public function create()
    {
        $user = Auth::user();
        if ($user) {
            $tokos = $user->tokos;
            return view('pesanan.create', compact('tokos'));
        } else {
            Log::error('User is not authenticated.');
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }
    }

    // Simpan pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'toko' => 'required|array',
        ]);

        $user = Auth::user();
        if ($user) {
            $pesanan = $user->pesanans()->create(); // Buat pesanan baru
            $pesanan->tokos()->sync($request->toko); // Sinkronkan toko dengan pesanan
            return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat.');
        } else {
            Log::error('User is not authenticated.');
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }
    }

    // Tampilkan detail pesanan
    public function show(Pesanan $pesanan)
    {
        $this->authorize('view', $pesanan);
        return view('pesanan.show', compact('pesanan'));
    }

    // Tampilkan form untuk mengedit pesanan
    public function edit(Pesanan $pesanan)
    {
        $this->authorize('update', $pesanan);
        $tokos = Auth::user()->tokos;
        return view('pesanan.edit', compact('pesanan', 'tokos'));
    }

    // Update pesanan
    public function update(Request $request, Pesanan $pesanan)
    {
        $this->authorize('update', $pesanan);

        $request->validate([
            'toko' => 'required|array',
        ]);

        $pesanan->tokos()->sync($request->toko); // Sinkronkan toko dengan pesanan

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    // Hapus pesanan
    public function destroy(Pesanan $pesanan)
    {
        $this->authorize('delete', $pesanan);
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
