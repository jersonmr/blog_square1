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

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Post $model) {
            $model->publication_date = now();
        });
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
