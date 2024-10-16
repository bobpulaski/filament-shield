<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ActionGroup;

class PersonsRelationManager extends RelationManager
{
    protected static string $relationship = 'persons';
    protected static ?string $inverseRelationship = 'client';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('surname')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(25),
            ]);
    }

    public function table(Table $table): Table
    {

        return $table
            ->recordTitleAttribute('surname')
            ->columns([
                Tables\Columns\TextColumn::make('surname'),
                Tables\Columns\TextColumn::make(name: 'name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AssociateAction::make()
                    ->recordSelectOptionsQuery(fn (Builder $query) => $query->whereBelongsTo(auth()->user()))
                    ->recordSelectSearchColumns(columns: ['surname', 'name'])
                    ->multiple()
                    ->preloadRecordSelect(),
            ])
            ->actions([
                ActionGroup::make([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\DissociateAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

}
