<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderItemResource\RelationManagers\OrderRelationManager;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Faker\Guesser\Name;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
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

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?int $navigationSort = 0;

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
                        'approved' => 'approved',
                        'rejected' => 'rejected',
                    ])->rules('required|in:cancelled,pending,approved,rejected'),
                TextInput::make('address')->required()->disabled(),
                TextInput::make('total_amount')->required()->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Order ID')->searchable(),
                TextColumn::make('user.name')
                ->url(fn($record)=> route('filament.admin.resources.users.edit',$record->user_id))
                ->label('Ordered By'),
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
                // TextColumn::make('state.name')->label('State'),
                TextColumn::make('city.name')->label('City'),
                TextColumn::make('address')->label('Address'),
                TextColumn::make('total_amount')->money(),

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
                // Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            OrderRelationManager::class,
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
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
