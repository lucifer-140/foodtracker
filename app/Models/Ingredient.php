<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'calories_per_100g',
        'protein_per_100g',
        'fat_per_100g',
        'carbs_per_100g',
    ];

    /**
     * The meals that contain the ingredient.
     */
    public function meals(): BelongsToMany
    {
        return $this->belongsToMany(Meal::class, 'ingredient_meal')
            ->withPivot('quantity', 'unit_id')
            ->withTimestamps();
    }
}
