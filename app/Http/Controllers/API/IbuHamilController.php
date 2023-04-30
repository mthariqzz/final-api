<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class IbuHamilController extends Controller
{
    public function index(Request $request)
    {
        $ibuHamilUsers = User::where('roles', 'ibuhamil')->get();

        $ibuHamilData = [];
        foreach ($ibuHamilUsers as $user) {
            $profile = $user->profile;
            if ($profile) {
                $pemeriksaan = $profile->pemeriksaan;
                $hpl = $profile->hpl;

                $ibuHamilData[] = [
                    'profile' => $profile,
                    'pemeriksaan' => $pemeriksaan,
                    'hpl' => $hpl,
                ];
            }
        }

        if (count($ibuHamilData) > 0) {
            return ResponseFormatter::success($ibuHamilData, 'Data ibu hamil beserta pemeriksaan dan HPL berhasil diambil');
        } else {
            return ResponseFormatter::error(null, 'Data ibu hamil tidak ditemukan', 404);
        }
    }
}
