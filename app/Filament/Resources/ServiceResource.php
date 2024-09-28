<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Client;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Leandrocfe\FilamentPtbrFormFields\Money;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $modelLabel = 'Serviço';

    protected static ?string $pluralModelLabel = 'Serviços';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('client_id')
                    ->label('Cliente')
                    // ->relationship('client', 'name')
                    ->options(Client::where('user_id', Auth::id())->get()->pluck('name', 'id'))
                    ->native(false)
                    ->searchable()
                    ->required(),
                TextInput::make('device')
                    ->label('Dispositivo')
                    ->required()
                    ->maxLength(100),
                TextInput::make('brand')
                    ->label('Marca')
                    ->required()
                    ->maxLength(100),
                TextInput::make('model')
                    ->label('Modelo')
                    ->maxLength(100)
                    ->default(null),
                TextInput::make('serial_number')
                    ->label('Número de Série')
                    ->maxLength(100)
                    ->default(null),
                Textarea::make('description')
                    ->label('Descrição')
                    ->autosize()
                    ->rows(4)
                    ->columnSpanFull(),
                Money::make('price')
                    ->label('Preço')
                    ->minLength(1)
                    ->maxLength(10)
                    ->live()
                    ->prefix('R$')
                    ->required(),
                Toggle::make('paid')
                    ->label('Pago')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.name')
                    ->label('Cliente')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('device')
                    ->label('Dispositivo')
                    ->searchable(),
                TextColumn::make('brand')
                    ->label('Marca')
                    ->searchable(),
                TextColumn::make('model')
                    ->label('Modelo')
                    ->searchable()
                    ->hidden(),
                TextColumn::make('serial_number')
                    ->label('Número de série')
                    ->searchable()
                    ->hidden(),
                TextColumn::make('price')
                    ->label('Preço')
                    ->money('BRL', true)
                    ->sortable(),
                IconColumn::make('paid')
                    ->label('Pago')
                    ->default(false)
                    ->boolean(),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->color('info'),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}