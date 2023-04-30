<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Hpl;
use Illuminate\Http\Request;

class HplController extends Controller
{
    public function fetch(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;

        if (!$profile) {
            return ResponseFormatter::error(null, 'Data profile tidak ditemukan', 404);
        }

        $hpl = $profile->hpl;

        if ($hpl) {
            return ResponseFormatter::success($hpl, 'Data HPL berhasil diambil');
        } else {
            return ResponseFormatter::error(null, 'Data HPL tidak ditemukan', 404);
        }
    }
}
