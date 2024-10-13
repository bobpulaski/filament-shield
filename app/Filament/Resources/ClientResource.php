<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\ClientStatus;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

//    public static function getEloquentQuery (): Builder
//    {
//        return parent::getEloquentQuery ()->where ('user_id', auth ()->id ());
//    }

    public static function form (Form $form): Form
    {
        return $form
            ->schema ([
                Forms\Components\TextInput::make ('name')
                    ->required ()
                    ->maxLength (255),
                Forms\Components\TextInput::make ('inn')
                    ->required ()
                    ->maxLength (255),
                Forms\Components\Select::make('status')
                    ->options(ClientStatus::class)
                    ->required (),
            ]);
    }


    public static function table (Table $table): Table
    {
        return $table
            ->columns ([
                Tables\Columns\TextColumn::make ('name'),
                Tables\Columns\TextColumn::make ('inn'),
                Tables\Columns\TextColumn::make ('status'),
            ])
            ->filters ([
                //
            ])
            ->actions ([
                Tables\Actions\EditAction::make (),
            ])
            ->bulkActions ([
                Tables\Actions\BulkActionGroup::make ([
                    Tables\Actions\DeleteBulkAction::make (),
                ]),
            ])
            ->modifyQueryUsing (function ($query) {
                return $query->where ('user_id', auth ()->id ());
            });
    }

    public static function getRelations (): array
    {
        return [
            //
        ];
    }

    public static function getPages (): array
    {
        return [
            'index' => Pages\ListClients::route ('/'),
            'create' => Pages\CreateClient::route ('/create'),
            'edit' => Pages\EditClient::route ('/{record}/edit'),
        ];
    }

//    protected function getHeaderActions (): array
//    {
//        return [
//            CreateAction::make ()
//                ->mutateFormDataUsing (function (array $data): array {
//                    $data['user_id'] = auth ()->id ();
//
//                    dd (\Filament\Panel\Concerns\auth ()->id ());
//
//                    return $data;
//                })
//        ];
//    }

}
