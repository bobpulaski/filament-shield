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
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\ClientStatus;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery (): Builder
    {
        return parent::getEloquentQuery ()->where ('user_id', auth ()->id ());
    }



    public static function form (Form $form): Form
    {
        $customColors = [
            ClientStatus::New->value => '#adb5bd', // Красный
            ClientStatus::Progress->value => '#2d728f', // Зеленый
            ClientStatus::Active->value => '#02c39a', // Синий
            ClientStatus::Lost->value => '#dd1c1a', // Желтый
            ClientStatus::Returned->value => '#5c8001', // Фиолетовый
            ClientStatus::Foreign->value => '#533e2d', // Голубой
            ClientStatus::Nontarget->value => '#bba0b2', // Белый
            ClientStatus::Eliminated->value => '#ffee32', // Серый
        ];

        return $form
            ->schema ([
                Forms\Components\TextInput::make ('name')
                    ->required ()
                    ->maxLength (255),
                Forms\Components\TextInput::make ('inn')
                    ->required ()
                    ->maxLength (255),
                Forms\Components\Select::make('status')
//                    ->options(ClientStatus::class)


                    ->options(fn() => collect(ClientStatus::cases())
                        ->mapWithKeys(function ($status) use ($customColors) {
                            // Возвращаем массив, где ключ - это значение статуса, а значение - HTML-метка с цветом
                            return [
                                $status->value => "<span style='color: {$customColors[$status->value]};'>{$status->getLabel()}</span>"
                            ];
                        })
                    )
                    ->native(false)
                    ->allowHtml()
                    ->default(1)
                    ->suffixIcon('heroicon-m-bookmark')
                    ->required (),
            ]);

    }



    public static function table (Table $table): Table
    {
        return $table
            ->columns ([
                Tables\Columns\TextColumn::make ('id'),
                Tables\Columns\TextColumn::make ('name'),
                Tables\Columns\TextColumn::make ('inn'),
                Tables\Columns\TextColumn::make ('status')
                ->badge(),
                Tables\Columns\TextColumn::make ('user_id'),
                Tables\Columns\TextColumn::make ('user.name'),
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
            ]);
//          Так нельзя, нужно ко всему ресурсу глобально, иначе можно в адресе подменить ID
//            ->modifyQueryUsing (function ($query) {
//                return $query->where ('user_id', auth ()->id ());
//            });
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
