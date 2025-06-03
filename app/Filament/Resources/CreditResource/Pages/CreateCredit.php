<?php

declare(strict_types=1);

namespace App\Filament\Resources\CreditResource\Pages;

use App\Filament\Resources\CreditResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCredit extends CreateRecord
{
    protected static string $resource = CreditResource::class;
}
