<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
    
}