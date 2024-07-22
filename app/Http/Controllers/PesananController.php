<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PesananController extends Controller
{
    use AuthorizesRequests;

    // Tampilkan semua pesanan milik user yang sedang login
    public function index()
    {
        $pesanans = Auth::user()->pesanans; 
        return view('pesanan.index', compact('pesanans'));
    }

    // Tampilkan form untuk membuat pesanan baru
    public function create()
    {
        $tokos = Auth::user()->tokos; 
        return view('pesanan.create', compact('tokos'));
    }

    // Simpan pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'toko' => 'required|array',
        ]);

        $pesanan = Auth::user()->pesanan()->create(); // Buat pesanan baru
        $pesanan->tokos()->sync($request->toko); // Sinkronkan toko dengan pesanan

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat.');
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
