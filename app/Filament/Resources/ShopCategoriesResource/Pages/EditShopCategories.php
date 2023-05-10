<?php

namespace App\Filament\Resources\ShopCategoriesResource\Pages;

use App\Filament\Resources\ShopCategoriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShopCategories extends EditRecord
{
    protected static ?string $title =   'ویرایش دسته بندی محصولات';
    protected static string $resource = ShopCategoriesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
