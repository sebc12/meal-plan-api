<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;


class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'week',
        'day_1',
        'day_2',
        'day_3',
        'day_4',
        'day_5',
        'day_6',
        'day_7',
    ];
    

    public function day1()
    {
        return $this->belongsTo(Recipe::class, 'day_1');
    }

    public function day2()
    {
        return $this->belongsTo(Recipe::class, 'day_2');
    }

    public function day3()
    {
        return $this->belongsTo(Recipe::class, 'day_3');
    }

    public function day4()
    {
        return $this->belongsTo(Recipe::class, 'day_4');
    }

    public function day5()
    {
        return $this->belongsTo(Recipe::class, 'day_5');
    }

    public function day6()
    {
        return $this->belongsTo(Recipe::class, 'day_6');
    }

    public function day7()
    {
        return $this->belongsTo(Recipe::class, 'day_7');
    }

    
}
