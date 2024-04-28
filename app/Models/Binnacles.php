<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Binnacles extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_event',
        'description',
        'user_id'
    ];

    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
