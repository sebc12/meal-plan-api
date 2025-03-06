<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;
use App\Models\Meal;


class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'week',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday'
    ];
    

    public function meals()
{
    return $this->hasMany(Meal::class);
}
    
}
