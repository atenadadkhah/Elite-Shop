<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class UserOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('تعداد کاربران', User::count()),
            Card::make('کاربران احراز شده', User::where('email_verified_at', '!=','')->count()),
        ];
    }
}
