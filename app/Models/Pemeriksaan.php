<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemeriksaan extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'profile_id',
        'tgl_pemeriksaan',

        'tekanan_darah',
        'berat_badan',
        'lila',
        'tinggi_badan',
        'keluhan',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
}
