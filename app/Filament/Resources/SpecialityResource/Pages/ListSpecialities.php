<?php

declare(strict_types=1);

namespace App\Filament\Resources\SpecialityResource\Pages;

use App\Filament\Resources\SpecialtyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSpecialities extends ListRecords
{
    protected static string $resource = SpecialtyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
