<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\CreditResource\RelationManagers\CoursesRelationManager;
use App\Filament\Resources\SpecialityResource\Pages\CreateSpeciality;
use App\Filament\Resources\SpecialityResource\Pages\EditSpeciality;
use App\Filament\Resources\SpecialityResource\Pages\ListSpecialities;
use App\Filament\Resources\SpecialityResource\Pages\ViewSpeciality;
use App\Models\Specialty;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SpecialtyResource extends Resource
{
    protected static ?string $model = Specialty::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Specialty Name'),
                TextInput::make('code')
                    ->required()
                    ->maxLength(5)
                    ->label('Code'),
                Checkbox::make('is_active')
                    ->default(true)
                    ->label('Is Active'),
                RichEditor::make('description')
                    ->disableToolbarButtons(['attachFiles', 'link', 'blockquote', 'codeBlock', 'bulletList'])
                    ->columnSpanFull()
                    ->label('Specialty Description'),
            ])->columns([
                'sm' => 1,
                'md' => 2,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('code')
                    ->sortable()
                    ->label('Code'),
                TextColumn::make('description')
                    ->limit(50)
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->sortable()
                    ->boolean()
                    ->sortable()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->label('Active'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CoursesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSpecialities::route('/'),
            'create' => CreateSpeciality::route('/create'),
            'view' => ViewSpeciality::route('/{record}'),
            'edit' => EditSpeciality::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) self::getModel()::count();
    }
}
