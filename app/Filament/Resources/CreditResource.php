<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\Action;
use App\Filament\Resources\CreditResource\RelationManagers\CoursesRelationManager;
use App\Filament\Resources\CreditResource\Pages\ListCredits;
use App\Filament\Resources\CreditResource\Pages\CreateCredit;
use App\Filament\Resources\CreditResource\Pages\EditCredit;
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
                Grid::make()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Credit Name'),
                        Checkbox::make('is_active')
                            ->default(true)
                            ->columnSpan(1)
                            ->label('Is Active'),
                    ])
                    ->columns()
                    ->columnSpanFull(),
                Grid::make()
                    ->columns([
                        'sm' => 3,
                        'md' => 3,
                        'lg' => 3,
                    ])
                    ->schema([
                        TextInput::make('amount')
                            ->required()
                            ->numeric()
                            ->step(0.5)
                            ->label('amount'),
                        TextInput::make('interest_rate')
                            ->required()
                            ->numeric()
                            ->step(0.5)
                            ->label('interest_rate'),
                        TextInput::make('term')
                            ->required()
                            ->numeric()
                            ->step(1)
                            ->inputMode('integer')
                            ->label('Term (months)'),
                    ]),
                RichEditor::make('description')
                    ->disableToolbarButtons(['attachFiles', 'link', 'blockquote', 'codeBlock', 'bulletList'])
                    ->label('Credit Description')
                    ->columnSpanFull(),
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
                TextColumn::make('description')
                    ->limit(50),
                IconColumn::make('is_active')
                    ->boolean()
                    ->sortable()
                    ->trueColor('success')
                    ->falseColor('danger'),
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
                    Action::make('delete')
                        ->requiresConfirmation()
                        ->icon('heroicon-o-trash'),
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
            'index' => ListCredits::route('/'),
            'create' => CreateCredit::route('/create'),
            'edit' => EditCredit::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return self::getModel()::count();
    }
}
