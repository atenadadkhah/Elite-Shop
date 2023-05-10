<?php

namespace App\Filament\Resources\ShopCategoriesResource\Pages;

use App\Filament\Resources\ShopCategoriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateShopCategories extends CreateRecord
{
    protected static ?string $title =   'ساخت دسته بندی محصولات';
    protected static string $resource = ShopCategoriesResource::class;
}
