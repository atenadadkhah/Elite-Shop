<?php

namespace App\Filament\Widgets;

use App\Models\Orders;
use App\Models\User;
use Carbon\Carbon;
use Faker\Core\Number;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    private function makeCurrentWeekStat($model, $column="created_at"): array
    {
        $records = $model::selectRaw("DATE($column) as day, COUNT(*) as count")
            ->groupBy('day')
            ->where($column, '>', Carbon::now()->subWeek())
            ->get();

        $recordArr = [];

        foreach ($records as $record){
            $recordArr[] = $record['count'];
        }
        return $recordArr;

    }

    private function calcProgress($records){
        end($records);
        $last = count($records) ? $records[count($records) - 1] : 0;
        $prev = prev($records) ?? 0;
        return $last - $prev;
    }

    protected function getCards(): array
    {
        $userStat = self::makeCurrentWeekStat(('App\Models\User'));
        $userProgress = self::calcProgress($userStat);

        $orderStat = self::makeCurrentWeekStat(('App\Models\Orders'), 'order_date');
        $orderProgress = self::calcProgress($orderStat);

        return [
            Card::make('مشتریان جدید', User::whereDate('created_at', Carbon::today())->count())
                ->description(abs($userProgress) . ($userProgress < 0 ? ' کاهش ' : ' افزایش '))
                ->descriptionIcon($userProgress < 0 ? 'heroicon-s-trending-down' : 'heroicon-s-trending-up')
                ->chart($userStat)
                ->color($userProgress < 0 ? 'danger' : 'success'),
            Card::make('سفارشات جدید', Orders::whereDate('order_date', Carbon::today())->count())
                ->description(abs($orderProgress) . ($orderProgress < 0 ? ' کاهش ' : ' افزایش '))
                ->descriptionIcon($orderProgress < 0 ? 'heroicon-s-trending-down' : 'heroicon-s-trending-up')
                ->chart($orderStat)
                ->color($orderProgress < 0 ? 'danger' : 'success'),
        ];
    }

}
