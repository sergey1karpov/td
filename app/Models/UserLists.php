<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserLists extends Model
{
    use HasFactory;

    protected $table = 'lists';

    protected $fillable = ['title', 'description'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'lists_users', 'list_id', 'id');
    }
}
