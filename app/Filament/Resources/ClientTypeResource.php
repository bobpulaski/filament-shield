<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientTypeResource\Pages;
use App\Filament\Resources\ClientTypeResource\RelationManagers;
use App\Models\ClientType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientTypeResource extends Resource
{
    protected static ?string $model = ClientType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make ('id'),
                Tables\Columns\TextColumn::make ('user_id'),
                Tables\Columns\TextColumn::make ('type'),
                Tables\Columns\TextColumn::make ('weight'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListClientTypes::route('/'),
            'create' => Pages\CreateClientType::route('/create'),
            'edit' => Pages\EditClientType::route('/{record}/edit'),
        ];
    }
}
