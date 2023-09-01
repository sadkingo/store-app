<?php

namespace App\Filament\Dashboard\Resources\OrderItemResource\Pages;

use App\Filament\Dashboard\Resources\OrderItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrderItem extends CreateRecord
{
    protected static string $resource = OrderItemResource::class;
}
