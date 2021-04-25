<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description'];

    public $timestamps = false;

    const CREATED_AT = 'publication_date';

    protected $casts = ['publication_date' => 'datetime:Y-m-d'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
