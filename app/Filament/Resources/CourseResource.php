<?php

namespace App\Filament\Resources;

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
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Course Name'),
                Forms\Components\Checkbox::make('is_active')
                    ->default(true)
                    ->label('Is Active'),

                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->required()
                            ->minLength(5)
                            ->maxLength(10)
                            ->unique(ignoreRecord: true)
                            ->label('Course Code'),
                        Forms\Components\TextInput::make('duration')
                            ->required()
                            ->numeric()
                            ->step(1)
                            ->minValue(10)
                            ->label('Duration'),
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->inputMode('decimal')
                            ->default(0)
                            ->step(1)
                            ->minValue(0)
                            ->label('Price'),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
                Forms\Components\Section::make('Related Data')
                    ->schema([
                        Forms\Components\Select::make('credit_id')
                            ->required()
                            ->multiple()
                            ->relationship('credits', 'name')
                            ->preload()
                            ->label('Credits'),
                        Forms\Components\Select::make('specialty_id')
                            ->required()
                            ->multiple()
                            ->relationship('specialties', 'name')
                            ->preload()
                            ->label('Credits'),
                    ])
                ->columns([
                    'md' => 2,
                ]),
                Forms\Components\RichEditor::make('description')
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
                Tables\Columns\TextColumn::make('id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->sortable()
                    ->label('Code'),
                Tables\Columns\TextColumn::make('credits.name')
                    ->sortable()
                    ->label('Credits'),
                Tables\Columns\TextColumn::make('specialties.name')
                    ->sortable()
                    ->label('Specialties'),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->filters([
                Tables\Filters\SelectFilter::make('Credits')
                    ->relationship('credits', 'name')
                    ->label('Credits'),
                Tables\Filters\SelectFilter::make('Specialties')
                    ->relationship('specialties', 'name')
                    ->label('Specialties'),
            ])->headerActions([
//                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge():?string
    {
        return self::getModel()::count();
    }
}
