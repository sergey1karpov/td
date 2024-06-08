<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ListElements extends Model
{
    use HasFactory;

    protected $table = 'list_elements';

    protected $fillable = ['description', 'list_id'];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'list_element_id', 'id');
    }
}
