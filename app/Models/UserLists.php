<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserLists extends Model
{
    use HasFactory;

    protected $table = 'lists';

    protected $fillable = ['title', 'description'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'lists_users', 'list_id', 'id');
    }

    public function elements(): HasMany
    {
        return $this->hasMany(ListElements::class, 'list_id', 'id');
    }
}
