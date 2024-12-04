<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Filament\Resources\ProductResource\Pages\EditProduct;
use App\Filament\Resources\ProductResource\Pages\ListProducts;
use App\Filament\Resources\ProductResource\Pages\CreateProduct;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn as MediaColumn;

class ProductResource extends Resource
{
    protected static ?string $model = product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Field untuk `name`
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                // Field untuk `description`
                TextInput::make('description')
                    ->label('Description')
                    ->required()
                    ->maxLength(255),

                // Field untuk `price`
                TextInput::make('price')
                    ->label('Price')
                    ->numeric()
                    ->required(),

                // Field untuk `stock`
                TextInput::make('stock')
                    ->label('Stock')
                    ->numeric()
                    ->required(),

                // Field untuk `media`
                SpatieMediaLibraryFileUpload::make(product::MEDIA_COLLECTION)
                    ->collection(Product::MEDIA_COLLECTION)
                    ->multiple()
                    ->maxFiles(5)
                    ->maxSize(1024) // Set max file size to 1MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                    ->downloadable()
                    ->columnSpanFull()
                    ->reorderable(),

                // Field untuk `created_by`
                Hidden::make('created_by')
                    ->default(Auth::id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Name')
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock')
                    ->searchable()
                    ->sortable(),

                SpatieMediaLibraryImageColumn::make(product::MEDIA_COLLECTION)
                    ->collection(product::MEDIA_COLLECTION)
                    ->label(product::MEDIA_COLLECTION),

                Tables\Columns\TextColumn::make('creator.name')
                    ->label('Created By')
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
