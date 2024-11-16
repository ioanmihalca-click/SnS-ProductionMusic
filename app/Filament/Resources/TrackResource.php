<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrackResource\Pages;
use App\Models\Track;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TrackResource extends Resource
{
    protected static ?string $model = Track::class;

    protected static ?string $navigationIcon = 'heroicon-o-musical-note';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Track Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn($state, Forms\Set $set) =>
                            $set('slug', \Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\Textarea::make('description')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Audio Files')
                    ->schema([
                        Forms\Components\FileUpload::make('original_file_path')
                            ->label('Original Track')
                            ->required()
                            ->acceptedFileTypes(['audio/mpeg', 'audio/wav', 'audio/mp3'])
                            ->directory('tracks/original')
                            ->preserveFilenames()
                            ->maxSize(50000), // 50MB în KB

                        Forms\Components\FileUpload::make('preview_file_path')
                            ->label('Preview Track')
                            ->required()
                            ->acceptedFileTypes(['audio/mpeg', 'audio/wav', 'audio/mp3'])
                            ->directory('tracks/preview')
                            ->preserveFilenames()
                            ->maxSize(50000),

                        Forms\Components\FileUpload::make('artwork_path')
                            ->label('Artwork')
                            ->image()
                            ->directory('tracks/artwork')
                            ->preserveFilenames()
                            ->helperText('Recommended size: 400x225 pixels (16:9 aspect ratio)')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(2048) // 2MB în KB
                    ])->columns(2),

                Forms\Components\Section::make('Metadata')
                    ->schema([
                        Forms\Components\TextInput::make('duration')
                            ->label('Original Track Duration (seconds)')
                            ->numeric()
                            ->required()
                            ->helperText('Enter the duration of the original track in seconds. Example: 180 for a 3 minute track.'),

                        Forms\Components\TextInput::make('preview_duration')
                            ->label('Preview Duration (seconds)')
                            ->numeric()
                            ->default(60)  // Implicit 60 secunde
                            ->helperText('Duration of the preview version. Default is 60 seconds.'),

                        Forms\Components\TextInput::make('bpm')
                            ->label('BPM')
                            ->numeric(),

                        Forms\Components\TextInput::make('key')
                            ->label('Musical Key'),

                        Forms\Components\Select::make('genres')
                            ->multiple()
                            ->relationship('genres', 'name')
                            ->preload(),

                        Forms\Components\Select::make('moods')
                            ->multiple()
                            ->relationship('moods', 'name')
                            ->preload(),
                    ])->columns(2),

                    Forms\Components\Section::make('Pricing & Status')
                    ->schema([
                        Forms\Components\TextInput::make('standard_license_price')
                            ->label('Standard License')
                            ->numeric()
                            ->prefix('$')
                            ->step('0.01')
                            ->required()
                            ->default(0.00)
                            ->helperText('Price for standard license - basic usage rights'),
                
                        Forms\Components\TextInput::make('premium_license_price')
                            ->label('Premium License')
                            ->numeric()
                            ->prefix('$')
                            ->step('0.01')
                            ->required()
                            ->default(0.00)
                            ->helperText('Price for premium license - extended usage rights'),
                
                        Forms\Components\TextInput::make('exclusive_license_price')
                            ->label('Exclusive License')
                            ->numeric()
                            ->prefix('$')
                            ->step('0.01')
                            ->required()
                            ->default(0.00)
                            ->helperText('Price for exclusive license - full rights transfer'),
                
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured Track'),
                
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'active' => 'Active',
                            ])
                            ->default('active')
                            ->required(),
                    ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration')
                    ->formatStateUsing(fn($state) => gmdate('i:s', $state))
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),

                Tables\Columns\TextColumn::make('plays_count')
                    ->label('Plays')
                    ->sortable(),

                Tables\Columns\TextColumn::make('downloads_count')
                    ->label('Downloads')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'active',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'active' => 'Active',
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTracks::route('/'),
            'create' => Pages\CreateTrack::route('/create'),
            'edit' => Pages\EditTrack::route('/{record}/edit'),
        ];
    }
}
