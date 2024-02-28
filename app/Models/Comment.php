<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // To Comment Controller
    //
    protected $fillable = [
        'user_id',
        'post_id',
        'comment'
    ];

    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
