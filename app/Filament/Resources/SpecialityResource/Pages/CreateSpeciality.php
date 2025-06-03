<?php

declare(strict_types=1);

namespace App\Filament\Resources\SpecialityResource\Pages;

use App\Filament\Resources\SpecialtyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSpeciality extends CreateRecord
{
    protected static string $resource = SpecialtyResource::class;
}
