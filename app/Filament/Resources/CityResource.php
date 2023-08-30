<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CityResource\Pages;
use App\Filament\Resources\CityResource\RelationManagers;
use App\Models\City;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CityResource extends Resource
    {
    protected static ?string $model = City::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form) : Form
        {
        return $form
            ->schema([
                Select::make('state_id')
                    ->relationship('state', 'name')
                    ->label('State'),
                TextInput::make('name'),
            ]);
        }
    public static function table(Table $table) : Table
        {
        return $table
            ->columns([
                // TextColumn::make('id')->sortable(),
                TextColumn::make('name')->label('City')->searchable(),
                TextColumn::make('state.city')
                    ->getStateUsing(function (Model $record)
                        {
                        // todo
                        return $record->state->find($record->state_id)->name;
                        }),
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

    public static function getRelations() : array
        {
        return [
            // RelationManagers\CityResource::class,
        ];
        }

    public static function getPages() : array
        {
        return [
            'index'  => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit'   => Pages\EditCity::route('/{record}/edit'),
        ];
        }
    }
