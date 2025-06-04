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
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('name')
                ->label('Course Name'),
            ExportColumn::make('code')
                ->label('Course Code'),
            ExportColumn::make('duration')
                ->label('Duration (hours)'),
            ExportColumn::make('price')
                ->label('Price'),
            ExportColumn::make('is_active')
                ->label('Active Status'),
            ExportColumn::make('description')
                ->label('Description'),
            ExportColumn::make('credits.name')
                ->label('Credits')
                ->listAsJson(),
            ExportColumn::make('specialties.name')
                ->label('Specialties')
                ->listAsJson(),
            ExportColumn::make('created_at')
                ->label('Created At'),
            ExportColumn::make('updated_at')
                ->label('Updated At'),
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
