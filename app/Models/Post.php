<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'publication_date'];

    public $timestamps = false;

    const CREATED_AT = 'publication_date';

    protected $casts = ['publication_date' => 'datetime'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApplySort(Builder $query, $sort)
    {
        if (is_null($sort)) {
            return;
        }

        $allowedSorts = ['newest', 'oldest'];
        $direction = $sort == 'newest' ? 'desc' : 'asc';

        if(! collect($allowedSorts)->contains($sort)) {
            abort(400, __('Invalid Query Parameter'));
        }

        $query->orderBy('publication_date', $direction);
    }
}
