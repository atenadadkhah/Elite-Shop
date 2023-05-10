<?php

namespace App\Filament\Resources\ShopCategoriesResource\Pages;

use App\Filament\Resources\ShopCategoriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShopCategories extends ListRecords
{
    protected static ?string $title =   'دسته بندی محصولات';
    protected static string $resource = ShopCategoriesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
