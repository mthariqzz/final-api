<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function fetch(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;

        if ($profile) {
            return ResponseFormatter::success($profile, 'Data profile berhasil diambil');
        } else {
            return ResponseFormatter::error(null, 'Data profile tidak ditemukan', 404);
        }
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;

        if (!$profile) {
            return ResponseFormatter::error(null, 'Data profile tidak ditemukan', 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255', // Tambahkan validasi untuk full_name
            'no_hp' => 'required|string|max:255',
            'kendaraan' => 'nullable|string|max:255',
            'golongan_darah' => [
                'nullable',
                'string',
                Rule::in(['A', 'B', 'AB', 'O']),
            ],
            'alamat' => 'nullable|string',
            'photo_url' => 'nullable|string',
        ]);

        $profile->update($request->all());

        return ResponseFormatter::success($profile, 'Data profile berhasil diperbarui');
    }
}
