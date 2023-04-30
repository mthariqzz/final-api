<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'user_id',
        'name',
        'full_name',
        'no_hp',
        'kendaraan',
        'golongan_darah',
        'alamat',
        'photo_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class, 'profile_id', 'id');
    }

    public function hpl()
    {
        return $this->hasOne(Hpl::class, 'profile_id', 'id');
    }
}
