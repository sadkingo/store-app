<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\RelationManagers\PostsRelationManager;
use App\Filament\Resources\CategoryResource\RelationManagers\StateRelationManager;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Http\Requests\RegisterRequest;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use App\Rules\StateCityRule;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('full_name')->rules(RegisterRequest::rules()['full_name']),
                TextInput::make('username')->rules(RegisterRequest::rules($form->model->id)['username']),
                TextInput::make('email')->rules(RegisterRequest::rules($form->model->id)['email']),
                TextInput::make('phone')->rules(RegisterRequest::rules()['phone']),
                TextInput::make('password')->password()->dehydrated(fn (?string $state): bool => filled($state)),
                TextInput::make('address')->rules(RegisterRequest::rules()['address']),
                Select::make('state_id')->options(function (Set $set) {
                    $set('city_id', 0);
                    return State::all()->pluck('name', 'id');
                })->label('State')->rules('required|numeric|exists:states,id')->live(),
                Select::make('city_id')->options(function (Get $get) {
                    return City::where('state_id', $get('state_id'))->get()->pluck('name', 'id');
                })->rules('required|numeric|exists:cities,id')->label('City'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id')->sortable()->hidden(),
                TextColumn::make('full_name')->searchable(),
                TextColumn::make('username')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('phone')->searchable(),
                TextColumn::make('address')->searchable(),
                TextColumn::make('state.name')
                    ->url(function (Model $record) {
                        return StateResource::getUrl('edit', ['record' => $record->state->id]);
                    }),
                TextColumn::make('city.name')
                    ->url(function (Model $record) {
                        return CityResource::getUrl('edit', ['record' => $record->city->id]);
                    }),
            ])
            ->filters([
                Tables\Filters\Filter::make('approved')
                    ->query(fn (Builder $query): Builder => $query->where('status', 'approved')),
                Tables\Filters\Filter::make('pending')
                    ->query(fn (Builder $query): Builder => $query->where('status', 'pending')),
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
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
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
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
