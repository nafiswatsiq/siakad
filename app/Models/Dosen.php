<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dosen extends Model
{
    protected $fillable = [
        'nip',
        'user_id',
        'alamat',
        'no_tlp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->hasOne(Kelas::class);
    }
}
