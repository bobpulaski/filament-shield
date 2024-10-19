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
use Filament\Tables\Actions\ActionGroup;

class ClientTypeResource extends Resource
{
    protected static ?string $model = ClientType::class;
    protected static ?string $navigationLabel = 'Тип клиента';
    protected static ?string $pluralLabel = 'Тип клиента';
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Словари';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type'),
                Forms\Components\TextInput::make('weight')
                    ->label('Вес')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('weight')
                    ->label('Вес')
                    ->sortable(true),
            ])->defaultSort('weight', 'asc')
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
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
