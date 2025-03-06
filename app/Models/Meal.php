<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;
use App\Models\Plan;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = ['plan_id', 'day', 'type', 'recipe_id'];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
