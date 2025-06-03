<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CreditResource\RelationManagers\CoursesRelationManager;
use App\Filament\Resources\SpecialityResource\Pages;
use App\Filament\Resources\SpecialityResource\RelationManagers;
use App\Models\Specialty;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
class SpecialtyResource extends Resource
{
    protected static ?string $model = Specialty::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Specialty Name'),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(5)
                    ->label('Code'),
                Forms\Components\Checkbox::make('is_active')
                    ->default(true)
                    ->label('Is Active'),
                Forms\Components\RichEditor::make('description')
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
                Tables\Columns\TextColumn::make('id')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->sortable()
                    ->label('Code'),
                Tables\Columns\IconColumn::make('is_active')
                    ->sortable()
                    ->boolean()
                    ->sortable()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->label('Active'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CoursesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSpecialities::route('/'),
            'create' => Pages\CreateSpeciality::route('/create'),
            'view' => Pages\ViewSpeciality::route('/{record}'),
            'edit' => Pages\EditSpeciality::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge():?string
    {
       return self::getModel()::count();
    }
}
