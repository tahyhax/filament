<?php

declare(strict_types=1);

namespace App\Filament\Resources\CreditResource\Pages;

use App\Filament\Resources\CreditResource;
use Filament\Actions\CreateAction;
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
