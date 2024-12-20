<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlbumResource\Pages;
use App\Models\Album;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Markdown;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class AlbumResource extends Resource
{
    protected static ?string $model = Album::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        Forms\Components\TextInput::make('slug')
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->unique(Album::class, 'slug', ignoreRecord: true),

                        RichEditor::make('description'),
                          

                        Forms\Components\FileUpload::make('artwork_path')
                            ->image()
                            ->directory('albums')
                            ->columnSpanFull(),

                            Forms\Components\Section::make('Tracks')
                            ->schema([
                                Forms\Components\Select::make('tracks')
                                    ->relationship(
                                        'tracks',
                                        'name',
                                        fn ($query) => $query->orderBy('album_track.position')
                                    )
                                    ->multiple()
                                    ->preload()
                                    ->searchable()
                                    ->columnSpanFull()
                                    ->afterStateUpdated(function ($state, $record) {
                                        // Când se selectează track-uri, le setăm poziția în ordinea selectării
                                        if ($record && $state) {
                                            foreach ($state as $index => $trackId) {
                                                $record->tracks()->updateExistingPivot($trackId, ['position' => $index]);
                                            }
                                        }
                                    }),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Section::make('Status & Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured Album')
                            ->default(false),

                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->default('draft')
                            ->required(),

                        // Forms\Components\TextInput::make('standard_license_price')
                        //     ->numeric()
                        //     ->prefix('$'),

                        // Forms\Components\TextInput::make('premium_license_price')
                        //     ->numeric()
                        //     ->prefix('$'),

                        // Forms\Components\TextInput::make('exclusive_license_price')
                        //     ->numeric()
                        //     ->prefix('$'),

                        Forms\Components\TagsInput::make('tags'),
                        
                        // Forms\Components\TextInput::make('category'),

                        Forms\Components\Section::make('SEO')
                            ->schema([
                                Forms\Components\Textarea::make('seo_description')
                                    ->label('SEO Description')
                                    ->rows(2),

                                Forms\Components\TagsInput::make('seo_keywords')
                                    ->label('SEO Keywords'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('artwork_path')
                    ->label('Artwork')
                    ->square(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tracks_count')
                    ->counts('tracks')
                    ->label('Tracks'),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'active' => 'success',
                        'inactive' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ]),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlbums::route('/'),
            'create' => Pages\CreateAlbum::route('/create'),
            'edit' => Pages\EditAlbum::route('/{record}/edit'),
        ];
    }
}