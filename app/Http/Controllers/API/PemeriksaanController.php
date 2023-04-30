<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
    public function fetch(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;

        if (!$profile) {
            return ResponseFormatter::error(null, 'Data profile tidak ditemukan', 404);
        }

        $pemeriksaan = $profile->pemeriksaan;

        if ($pemeriksaan->count() > 0) {
            return ResponseFormatter::success($pemeriksaan, 'Data pemeriksaan berhasil diambil');
        } else {
            return ResponseFormatter::error(null, 'Data pemeriksaan tidak ditemukan', 404);
        }
    }
}
