<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListElements extends Model
{
    use HasFactory;

    protected $table = 'list_elements';

    protected $fillable = ['description', 'image', 'list_id'];
}
