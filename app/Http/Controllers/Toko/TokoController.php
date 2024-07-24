<?php
namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the currently logged-in user
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Get all the stores owned by the currently logged in user
        $tokos = $user->tokos;
        return view('toko.index', compact('tokos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the form view to create a new store
        return view('toko.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'nama_toko' => 'required',
            'address' => 'required',
        ]);

        // Try to create a new store
        try {
            Toko::create([
                'nama_toko' => $request->nama_toko,
                'address' => $request->address,
                'user_id' => Auth::user()->id,
            ]);

            // Redirect back to the toko page with a success message
            return redirect()->route('toko.index')->with('success', 'Store created successfully');
        } catch (\Throwable $e) {
            // Log error message if failed to create a store
            Log::error($e->getMessage());

            // Redirect back to the toko page with an error message
            return redirect()->route('toko.index')->with('error', 'Store creation failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Get store data with connected user information
        $toko = Toko::with('user')->find($id);

        // Periksa apakah data ditemukan
        if ($toko === null) {
            return redirect()->route('toko.index')->with('error', 'Toko tidak ditemukan');
        }

        // Return the toko page view with store data
        return view('toko.show', compact('toko'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find a store based on the id
        $toko = Toko::findOrFail($id);

        // Return the form view edit with the store data
        return view('toko.edit', compact('toko'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the input data
        $request->validate([
            'nama_toko' => 'required',
            'address' => 'required',
        ]);

        // Try to update the store
        try {
            // Find a store based on the id
            $toko = Toko::findOrFail($id);

            // Update the store name and address
            $toko->nama_toko = $request->nama_toko;
            $toko->address = $request->address;

            // Save the changes
            $toko->save();

            // Redirect back to the toko page with a success message
            return redirect()->route('toko.index')->with('success', 'Store updated successfully');
        } catch (\Throwable $e) {
            // Log error message if failed to update store
            Log::error($e->getMessage());

            // Redirect back to the toko page with an error message
            return redirect()->route('toko.index')->with('error', 'Store update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Try to delete the store
        try {
            // Find a store based on the id
            $toko = Toko::findOrFail($id);
            // Delete the store
            $toko->delete();

            // Redirect back to the toko page with a success message
            return redirect()->route('toko.index')->with('success', 'Store deleted successfully');
        } catch (\Throwable $e) {
            // Log error message if failed to delete store
            Log::error($e->getMessage());
            // Go back to the previous page with an error message
            return back()->withErrors(['error' => 'Store deletion failed']);
        }
    }
}
