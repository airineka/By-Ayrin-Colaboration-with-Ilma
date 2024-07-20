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
        $pesanan = Auth::user()->pesanan;
        return view('pesanan.index', compact('pesanan'));
    }

    // Tampilkan form untuk membuat pesanan baru
    public function create()
    {
        $tokos = Auth::user()->toko;
        return view('pesanan.create', compact('toko'));
    }

    // Simpan pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'toko' => 'required|array',
        ]);

        $pesanan = Auth::user()->pesanan()->create();
        $pesanan->toko()->sync($request->toko);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    // Tampilkan detail pesanan
    public function show(PesananController $pesanan)
    {
        $this->authorize('view', $pesanan);
        return view('pesanan.show', compact('pesanan'));
    }

    // Tampilkan form untuk mengedit pesanan
    public function edit(PesananController $pesanan)
    {
        $this->authorize('update', $pesanan);
        $tokos = Auth::user()->tokos;
        return view('pesanan.edit', compact('pesanan', 'tokos'));
    }

    // Update pesanan
    public function update(Request $request, PesananController $pesanan)
    {
        $this->authorize('update', $pesanan);

        $request->validate([
            'toko' => 'required|array',
        ]);

        $pesanan->toko()->sync($request->toko);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    // Hapus pesanan
    public function destroy(PesananController $pesanan)
    {
        $this->authorize('delete', $pesanan);
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
