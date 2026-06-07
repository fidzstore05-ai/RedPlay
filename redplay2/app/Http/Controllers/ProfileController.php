<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user profile details.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username,' . $user->id_user . ',id_user',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id_user . ',id_user',
            'gender' => 'nullable|string|in:Pria,Wanita,Lainnya',
            'foto_profile_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
            'username.unique' => 'Username sudah digunakan oleh akun lain.',
            'gender.in' => 'Pilihan jenis kelamin tidak valid.',
            'foto_profile_file.image' => 'File harus berupa gambar.',
            'foto_profile_file.max' => 'Ukuran gambar maksimal 2MB.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Handle Avatar File Upload
        if ($request->hasFile('foto_profile_file')) {
            // Delete old avatar if exists
            if ($user->foto_profile && File::exists(public_path($user->foto_profile))) {
                File::delete(public_path($user->foto_profile));
            }

            $file = $request->file('foto_profile_file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/avatars'), $filename);
            
            $user->foto_profile = 'uploads/avatars/' . $filename;
        }

        // Handle Password Update if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update basic details
        $user->nama = $data['nama'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->gender = $data['gender'];
        
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
