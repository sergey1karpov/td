<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListUsers extends Model
{
    use HasFactory;

    protected $table = 'lists_users';

    protected $fillable = ['user_id', 'list_id', 'role'];
}
