<?php

namespace App\Filament\Dashboard\Resources;

use App\Filament\Dashboard\Resources\OrderItemResource\RelationManagers\OrderRelationManager;
use App\Filament\Dashboard\Resources\OrderResource\Pages;
use App\Filament\Dashboard\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    Group::make()
                    ->relationship('user')
                    ->schema([
                        TextInput::make('full_name')->disabled(),
                        TextInput::make('phone')->required()->disabled(),
                    ]),
                    Group::make()
                    ->relationship('city')
                    ->schema([
                        TextInput::make('name')->required()->disabled(),
                    ]),
                    TextInput::make('id')->required()->disabled(),
                    TextInput::make('payment_type')->required()->disabled(),
                    Select::make('status')
                        ->options([
                            'cancelled' => 'cancelled',
                            'pending' => 'pending',
                        ])->rules('required|in:cancelled,pending'),
                    TextInput::make('address')->required()->disabled(),
                    TextInput::make('total_amount')->required()->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Order ID')->searchable(),
                TextColumn::make('user.name')->label('Ordered By'),
                TextColumn::make('phone'),
                TextColumn::make('payment_type')->badge()->color('success'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'cancelled' => 'gray',
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    }),
                TextColumn::make('city.name')->label('City'),
                TextColumn::make('address')->label('Address'),
                TextColumn::make('total_amount')->money(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                // Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            OrderRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
