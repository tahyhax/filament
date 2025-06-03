<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\CourseResource\Pages\ListCourses;
use App\Filament\Resources\CourseResource\Pages\CreateCourse;
use App\Filament\Resources\CourseResource\Pages\EditCourse;
use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Course Name'),
                Checkbox::make('is_active')
                    ->default(true)
                    ->label('Is Active'),

                Grid::make()
                    ->schema([
                        TextInput::make('code')
                            ->required()
                            ->minLength(5)
                            ->maxLength(10)
                            ->unique(ignoreRecord: true)
                            ->label('Course Code'),
                        TextInput::make('duration')
                            ->required()
                            ->numeric()
                            ->step(1)
                            ->minValue(10)
                            ->label('Duration'),
                        TextInput::make('price')
                            ->numeric()
                            ->inputMode('decimal')
                            ->default(0)
                            ->step(1)
                            ->minValue(0)
                            ->label('Price'),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
                Section::make('Related Data')
                    ->schema([
                        Select::make('credit_id')
                            ->required()
                            ->multiple()
                            ->relationship('credits', 'name')
                            ->preload()
                            ->label('Credits'),
                        Select::make('specialty_id')
                            ->required()
                            ->multiple()
                            ->relationship('specialties', 'name')
                            ->preload()
                            ->label('Credits'),
                    ])
                ->columns([
                    'md' => 2,
                ]),
                RichEditor::make('description')
                    ->disableToolbarButtons(['attachFiles', 'link', 'blockquote', 'codeBlock', 'bulletList'])
                    ->columnSpanFull()
                    ->label('Course Description'),
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
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('code')
                    ->sortable()
                    ->label('Code'),
                TextColumn::make('credits_count')
                    ->badge()
                    ->counts('credits')
                    ->label('Credits'),
                TextColumn::make('specialties_count')
                    ->badge()
                    ->counts('specialties')
                    ->label('Specialties'),
                TextColumn::make('description')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->filters([
                SelectFilter::make('Credits')
                    ->relationship('credits', 'name')
                    ->label('Credits'),
                SelectFilter::make('Specialties')
                    ->relationship('specialties', 'name')
                    ->label('Specialties'),
            ])->headerActions([
                //                Tables\Actions\CreateAction::make(),
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
            //            RelationManagers\CreditsRelationManager::class
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCourses::route('/'),
            'create' => CreateCourse::route('/create'),
            'edit' => EditCourse::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return self::getModel()::count();
    }
}
