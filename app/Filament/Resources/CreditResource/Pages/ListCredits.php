<?php

declare(strict_types=1);

namespace App\Filament\Resources\CreditResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\CreditResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCredits extends ListRecords
{
    protected static string $resource = CreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
