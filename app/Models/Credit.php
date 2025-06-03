<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Credit extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'amount',
        'term',
        'interest_rate',
        'is_active',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'term' => 'integer',
        'is_active' => 'boolean',
    ];

    public function courses(): MorphToMany
    {
        return $this->morphToMany(Course::class, 'courseable');
    }
}
