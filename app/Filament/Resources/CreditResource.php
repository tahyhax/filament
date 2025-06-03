<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\CreditResource\Pages;
use App\Filament\Resources\CreditResource\RelationManagers;
use App\Models\Credit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CreditResource extends Resource
{
    protected static ?string $model = Credit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Credit Name'),
                        Forms\Components\Checkbox::make('is_active')
                            ->default(true)
                            ->columnSpan(1)
                            ->label('Is Active'),
                    ])
                    ->columns()
                    ->columnSpanFull(),
                Forms\Components\Grid::make()
                    ->columns([
                        'sm' => 3,
                        'md' => 3,
                        'lg' => 3,
                    ])
                    ->schema([
                        Forms\Components\TextInput::make('amount')
                            ->required()
                            ->numeric()
                            ->step(0.5)
                            ->label('amount'),
                        Forms\Components\TextInput::make('interest_rate')
                            ->required()
                            ->numeric()
                            ->step(0.5)
                            ->label('interest_rate'),
                        Forms\Components\TextInput::make('term')
                            ->required()
                            ->numeric()
                            ->step(1)
                            ->inputMode('integer')
                            ->label('Term (months)'),
                    ]),
                Forms\Components\RichEditor::make('description')
                    ->disableToolbarButtons(['attachFiles', 'link', 'blockquote', 'codeBlock', 'bulletList'])
                    ->label('Credit Description')
                    ->columnSpanFull(),
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
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable()
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                    Tables\Actions\Action::make('delete')
                        ->requiresConfirmation()
                        ->icon('heroicon-o-trash'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CoursesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCredits::route('/'),
            'create' => Pages\CreateCredit::route('/create'),
            'edit' => Pages\EditCredit::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return self::getModel()::count();
    }
}
