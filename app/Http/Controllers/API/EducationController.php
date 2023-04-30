<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Education;

class EducationController extends Controller
{
    public function edukasi()
    {
        $educations = Education::all();
        return ResponseFormatter::success($educations, 'Data edukasi berhasil diambil');
    }
}
