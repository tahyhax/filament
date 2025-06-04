<?php

declare(strict_types=1);

namespace App\Filament\Exports;

use App\Models\Course;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class CoursesExporter extends Exporter
{
    protected static ?string $model = Course::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name'),
            ExportColumn::make('code'),
            ExportColumn::make('duration'),
            ExportColumn::make('is_active'),
            ExportColumn::make('description'),
            ExportColumn::make('credits')
                ->label('Credit Name')
                ->listAsJson(),
            ExportColumn::make('specialities.name')
                ->label('Speciality Name')
                ->listAsJson(),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $format = 'Your courses export has completed and %s %s exported.';
        $body = sprintf($format, number_format($export->successful_rows), str('row')->plural($export->successful_rows));

        if (($failedRowsCount = $export->getFailedRowsCount()) !== 0) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
