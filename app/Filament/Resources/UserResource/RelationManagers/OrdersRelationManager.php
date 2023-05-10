<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\Orders;
use App\Models\Products;
use Ariaieboy\FilamentJalaliDatetime\JalaliDateTimeColumn;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdersRelationManager extends RelationManager
{

    protected static ?string $pluralLabel = 'سفارشات';

    protected static ?string $pluralModelLabel = 'سفارشات';
    protected static string $relationship = 'orders';

    protected static ?string $recordTitleAttribute = 'product_id';
    protected static ?string $modelLabel = 'سفارش';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('product_id')
                    ->relationship('product', 'name')
                ->required()
                ->label('محصول'),
                Select::make('color_id')
                    ->relationship('color', 'name')
                ->required()
                    ->label('رنگ'),
                Select::make('size_id')
                    ->relationship('size', 'size')
                ->required()
                    ->label('اندازه'),
                Forms\Components\TextInput::make('quantity')
                    ->label('تعداد')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(100)
                    ->required(),
                Select::make('status')
                    ->options([
                        '1' => 'درحال پردازش',
                        '2' => 'در انتظار',
                        '3' => 'کامل شده',
                        '4' => 'لغو شده',
                    ])
                    ->label('وضعیت')
                ->required(),
                Forms\Components\Hidden::make('reference')
                ->hiddenOn('edit')
                ->default('PAY' . substr(sha1(microtime()), rand(0,30),  6))

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')
                    ->label('آیدی'),
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
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public function canCreate() : bool
    {
        return false;
    }
}
