<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'attached',
        'user_id',
        'title',
        'description'
    ];

    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
