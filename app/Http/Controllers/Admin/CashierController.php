<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CashierController extends Controller
{
    public function index()
    {
        // Mengambil user dengan role cashier
        $cashiers = User::where('role', 'cashier')->get();
        return view('admin.cashiers.manage-cashiers', compact('cashiers'));
    }

    // Gunakan metode ini untuk menangani perubahan role dari modal
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $user->update([
            'role' => $request->role
        ]);

        return redirect()->route('manage-cashiers.index')
            ->with('success', "Role {$user->name} berhasil diperbarui menjadi " . ucfirst($request->role) . ".");
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('manage-cashiers.index')
            ->with('success', "Akun kasir berhasil dihapus.");
    }
    
    public function create()
    {
        return view('admin.cashiers.create-cashier');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password wajib di-hash
            'role' => 'cashier', // Default role untuk halaman ini
        ]);

        return redirect()->route('manage-cashiers.index')->with('success', 'Akun kasir berhasil didaftarkan!');
    }
}