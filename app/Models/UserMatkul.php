<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMatkul extends Model
{
    protected $fillable = [
        'user_id',
        'matkul_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }
}
