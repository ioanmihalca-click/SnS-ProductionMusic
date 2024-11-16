<?php

namespace App\Filament\Widgets;

use App\Models\Track;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestTracks extends BaseWidget
{
    protected static ?int $sort = 2;
    
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Track::latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration')
                    ->formatStateUsing(fn ($state) => gmdate('i:s', $state)),
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
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->url(fn (Track $record): string => route('filament.admin.resources.tracks.edit', $record)),
            ]);
    }
}