<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopCategoriesResource\Pages;
use App\Filament\Resources\ShopCategoriesResource\RelationManagers;
use App\Models\ShopCategories;
use bootstrap\Helper\Helper;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ShopCategoriesResource extends Resource
{
    protected static ?string $model = ShopCategories::class;

    protected static ?string $pluralLabel = 'دسته بندی محصولات';

    protected static ?string $pluralModelLabel = 'دسته بندی محصولات';
    protected static ?string $navigationGroup = 'فروشگاه';

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationLabel = 'دسته بندی محصولات';
    protected static ?string $modelLabel = 'دسته بندی محصولات';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('title')
                            ->reactive()
                            ->label('دسته')
                            ->required()
                            ->maxLength(200)
                            ->afterStateUpdated(function (Closure $set, $state){
                                $set('slug', Helper::pslug($state));
                            }),
                        Forms\Components\TextInput::make('slug')->required()
                            ->label('اسلاگ')
                            ->minLength(5)
                            ->maxLength(430)
                            ->unique(ignoreRecord: true)
                    ]),
                    Select::make('sub')
                        ->options(ShopCategories::where('sub', 0)->get()->pluck('title','id'))
                        ->label('مرجع')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('دسته')
                    ->searchable(),
                Tables\Columns\TextColumn::make('parentCategoty.title')
                ->label('دسته ی مرجع'),
                Tables\Columns\TextColumn::make('slug')
                    ->label('اسلاگ')
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShopCategories::route('/'),
        ];
    }
}
