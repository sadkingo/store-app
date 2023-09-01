<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductImageResource\RelationManagers\ProductImageRelationManager;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
    {
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form) : Form
        {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Textarea::make('description')->required(),
                TextInput::make('price')->numeric()->required(),
                FileUpload::make('image_url')
                    ->disk('public')
                    ->directory('product-imgs')
                    ->visibility('private')
                    ->image()
                    ->dehydrated(false),
            ]);
        }

    public static function table(Table $table) : Table
        {
        return $table
            ->columns([
                // TextColumn::make('id')->sortable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('description')->limit(50),
                TextColumn::make('price')->sortable(),
                TextColumn::make('image_url')->limit(30),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
        }
    public static function getEloquentQuery() : Builder
        {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
        }
    public static function getRelations() : array
        {
        return [
            ProductImageRelationManager::class,
        ];
        }

    public static function getPages() : array
        {
        return [
            'index'  => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit'   => Pages\EditProduct::route('/{record}/edit'),
        ];
        }
    }
