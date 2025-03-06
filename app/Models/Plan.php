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
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday'
    ];
    

    public function monday()
    {
        return $this->belongsTo(Recipe::class, 'monday');
    }

    public function tuesday()
    {
        return $this->belongsTo(Recipe::class, 'tuesday');
    }

    public function wednesday()
    {
        return $this->belongsTo(Recipe::class, 'wednesday');
    }

    public function thursday()
    {
        return $this->belongsTo(Recipe::class, 'thursday');
    }

    public function friday()
    {
        return $this->belongsTo(Recipe::class, 'friday');
    }

    public function saturday()
    {
        return $this->belongsTo(Recipe::class, 'saturday');
    }

    public function sunday()
    {
        return $this->belongsTo(Recipe::class, 'sunday');
    }

    
}
