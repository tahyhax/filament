<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Course extends Model
{
    use SoftDeletes;
    use Notifiable;
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'code',
        'duration',
        'price',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration' => 'integer',
        'is_active' => 'boolean',
    ];

    public function credits(): MorphToMany
    {
        return $this->morphedByMany(Credit::class, 'courseable');
    }

    public function specialties(): MorphToMany
    {
        return $this->morphedByMany(Specialty::class, 'courseable');
    }
}
