<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AddressResource\Pages;
use App\Filament\Resources\AddressResource\RelationManagers;
use App\Models\Addresses;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;


class AddressResource extends Resource
{
    protected static ?string $model = Addresses::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Field untuk `user_id`
                Hidden::make('user_id')
                    ->default(auth()->id()),
                // Field untuk `address`
                TextInput::make('address')
                    ->label('Address')
                    ->required()
                    ->maxLength(255),

                // Field untuk `city`
                TextInput::make('city')
                    ->label('City')
                    ->required()
                    ->maxLength(100),

                // Field untuk `postal_code`
                TextInput::make('postal_code')
                    ->label('Postal Code')
                    ->numeric()
                    ->required()
                    ->maxLength(10),

                // Field untuk `country`
                TextInput::make('country')
                    ->label('Country')
                    ->required()
                    ->maxLength(100),

                // Field untuk `created_by`
                Hidden::make('created_by')
                    ->default(auth()->id()), // Set nilai default berdasarkan pengguna saat ini
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                // Kolom untuk `address`
                Tables\Columns\TextColumn::make('address')
                    ->label('Address')
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        return \Illuminate\Support\Str::words($state, 5, '...');
                    })
                    ->sortable(),

                // Kolom untuk `city`
                Tables\Columns\TextColumn::make('city')
                    ->label('City')
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        return \Illuminate\Support\Str::words($state, 5, '...');
                    })
                    ->sortable(),

                // Kolom untuk `postal_code`
                Tables\Columns\TextColumn::make('postal_code')
                    ->label('Postal Code')
                    ->searchable()
                    ->sortable(),

                // Kolom untuk `country`
                Tables\Columns\TextColumn::make('country')
                    ->label('Country')
                    ->searchable()
                    ->sortable(),

                // Kolom untuk `created_by`
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created at')
                    ->dateTime('F d, Y')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListAddresses::route('/'),
            'create' => Pages\CreateAddress::route('/create'),
            'edit' => Pages\EditAddress::route('/{record}/edit'),
        ];
    }
}
