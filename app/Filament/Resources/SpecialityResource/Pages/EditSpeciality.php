<?php

declare(strict_types=1);

namespace App\Filament\Resources\SpecialityResource\Pages;

use App\Filament\Resources\SpecialtyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpeciality extends EditRecord
{
    protected static string $resource = SpecialtyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
