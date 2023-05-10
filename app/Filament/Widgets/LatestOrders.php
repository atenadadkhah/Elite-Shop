<?php

namespace App\Filament\Widgets;

use App\Models\Orders;
use Ariaieboy\FilamentJalaliDatetime\JalaliDateTimeColumn;
use Closure;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestOrders extends BaseWidget
{
    protected static ?string $heading = 'آخرین سفارشات';
    protected int | string | array $columnSpan = 2;
    protected static ?int $sort = 2;
    protected function getTableQuery(): Builder
    {
        return Orders::query()->latest('order_date');
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('reference')
                ->label('آیدی'),
            Tables\Columns\TextColumn::make('user.name')
                ->label('کاربر'),
            Tables\Columns\TextColumn::make('product.name')
                ->label('محصول')
                ->url(fn (Orders $record): string => route('singleProduct', ['slug' => $record->product->slug])),
            Tables\Columns\TextColumn::make('color.name')
                ->label('رنگ'),
            Tables\Columns\TextColumn::make('size.size')
                ->label('اندازه'),
            Tables\Columns\TextColumn::make('quantity')
                ->label('تعداد'),
            BadgeColumn::make('status')
                ->label('وضعیت')
                ->enum([
                    '1' => 'درحال پردازش',
                    '2' => 'در انتظار',
                    '3' => 'کامل شده',
                    '4' => 'لغو شده',
                ])->colors([
                    'warning' => '1',
                    'danger' => '4',
                    'secondary' => '2',
                    'success' => '3',
                ]),
            JalaliDateTimeColumn::make('order_date')
                ->date()
                ->label('تاریخ سفارش'),
        ];
    }
}
