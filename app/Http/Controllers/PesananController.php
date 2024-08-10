<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;  
use App\Models\Toko\Pesanan;
use App\Models\User; 
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
        $pesanan = Pesanan::all();
        $user= Auth::user()->id;
        if ($user === null) {
            return redirect()->back()->with("error, anda harus login terlebih dahulu");
        }
            $pesanan = user::find($user)->pesanan;
            $pesanan = user::find($user)->toko;
            $pesanan = $user->pesanan;
    
            return view('pages.pesanan.index',compact('pesanan'));
        }
    

    // Tampilkan form untuk membuat pesanan baru
    public function create()
    {
        $pesanan= Auth::user()->pesanan;
            return view('pages.pesanan.create', compact('pesanan'));
        } 
    

    // Simpan pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'nama' => 'required',
        ]);

        // Try to create a new oder
        try {
                Pesanan::create([
                'pesanan' => $request->pesanan,
                'toko' => $request->toko,
                'total' => $request->total,
                'user_id' => Auth::user()->id,
            ]);
            // Redirect back to the page with a succes message
            return redirect()->route('pesanan.index')->with('succes','order berhasil dibuat.');
        } catch (\Throwable $e) {
            log::error($e->getMessage());

            return redirect()->route('pesanan.index')->with('error', 'order gagal dibuat.');
            }
        }
       
           
    // Tampilkan detail pesanan
    public function show($id)
    {
        $pesanan = pesanan::with('user')->find($id);
        return view('pages.pesanan.show', compact('pesanan'));
    }

    // Tampilkan form untuk mengedit pesanan
    public function edit(Pesanan $pesanan)
    {
        // Return the form view edit with the order data
        return view('pages.pesanan.edit', compact('pesanan'));
    }

    // Update pesanan
    public function update(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'user_id' => 'required',
            'nama_pesanan' => 'required',
        ]);

        // Try to update the order
        try {
            $pesanan->nama_pesanan = $request->nama_pesanan;
            $pesanan->toko = $request->toko;
            // Save the changes
            $pesanan->save();

            return redirect()->route('pesanan.index')->with('succes', 'Sumber daya berhasil diperbarui');
        } catch (\Throwable $e) {
            log::error($e->getMessage());
            return redirect()->route('pesanan.index')->with('error','Pesanan gagal dibuat');
        }
        }

    // Hapus pesanan dari database
    public function destroy(Pesanan $pesanan)
    {
        // Try to delete the order
    try { 
        // Delete the order
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Sumber daya berhasil dihapus');
    }   catch (\Throwable $e) {
            Log::error($e->getMessage());
  
            return back()->withErrors(['error' => 'Sumber Daya gagal dihapus!']); 
    }
    }   
}
