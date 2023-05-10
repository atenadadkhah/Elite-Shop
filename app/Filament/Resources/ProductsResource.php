<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductsResource\Pages;
use App\Models\Products;
use Ariaieboy\FilamentJalaliDatetime\JalaliDateTimeColumn;
use bootstrap\Helper\Helper;
use Closure;
use Filament\Forms;

use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;


class ProductsResource extends Resource
{
    protected static ?string $model = Products::class;
    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'فروشگاه';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'محصولات';

    protected static ?string $pluralLabel = 'محصولات';
    protected static ?string $modelLabel = 'محصول';
    protected static ?string $pluralModelLabel = 'محصولات';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)->schema([
                    Grid::make()->schema([
                        Card::make()->schema([
                            Grid::make(2)->schema([
                                Forms\Components\TextInput::make('name')
                                    ->reactive()
                                    ->label('نام محصول')
                                    ->required()
                                    ->maxLength(400)
                                    ->afterStateUpdated(function (Closure $set, $state){
                                        $set('slug', Helper::pslug($state));
                                    })
                                    ,
                                Forms\Components\TextInput::make('slug')->required()
                                    ->label('اسلاگ')
                                    ->minLength(5)
                                    ->maxLength(430)
                                    ->unique(ignoreRecord: true)
                            ]),
                            Forms\Components\MarkdownEditor::make('description')
                                ->label('توضیحات')
                                ->disableToolbarButtons(['attachFiles','codeBlock']),
                        ]),
                        Section::make('رنگ و اندازه')->schema([
                            Grid::make(2)->schema([
                            Forms\Components\MultiSelect::make('color_id')
                                ->relationship('color', 'name')
                                ->required()
                                ->label('رنگ ها')
                                ->placeholder('رنگ های موجود را انتخاب کنید'),
                            Forms\Components\MultiSelect::make('size_id')
                                ->relationship('size', 'size')
                                ->required()
                                ->label('اندازه ها')
                                ->placeholder('اندازه های موجود را انتخاب کنید'),
                                ])
                        ]),
                        Section::make('تصویر')->schema([
                            Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                                ->disk('cloudinary')
                                ->required()
                                ->image()
                                ->maxFiles(1)
                                ->label('')
                                ->collection('products'),
                        ])->collapsible(),
                        Section::make('قیمت')->schema([
                            Grid::make()->schema([
                                Forms\Components\TextInput::make('previous_price')
                                    ->nullable()
                                    ->numeric()
                                    ->label('قیمت به دلار'),
                                Forms\Components\TextInput::make('today_price')
                                    ->required()
                                    ->numeric()
                                    ->label('قیمت فروش'),
                                Forms\Components\TextInput::make('discount')
                                    ->nullable()
                                    ->numeric()
                                    ->label('تخفیف')
                                    ->minValue(1)
                                    ->maxValue(100)
                                    ->helperText('می توانید یک عدد را به عنوان درصد تخفیف وارد کنید'),
                            ])
                        ])

                    ])->columnSpan(2),

                    Grid::make(1)->schema([
                        Section::make('وضعیت در انبار')->schema([
                            Forms\Components\Toggle::make('instock')
                                ->required()
                                ->label('در انبار')
                                ->helperText('اگر خاموش باشد این محصول توسط کاربر قابل خریداری نمی شود'),
                        ]),
                        Section::make('دسته بندی ها')->schema([
                            Forms\Components\MultiSelect::make('shop_category_id')
                                ->relationship('category', 'title')
                                ->required()
                                ->label('دسته ها')
                                ->placeholder('دسته های مرتبط را انتخاب کنید'),
                        ]),

                        Section::make('ویژگی های محصول')->schema([
                            Repeater::make('features')
                                ->label('ویژگی ها')
                                ->schema([
                                TextInput::make('feature')
                                    ->label('ویژگی')
                                    ->required(),
                            ])->collapsible()
                            ->nullable()
                                ->orderable()
                        ])
                    ])->columnSpan(1),

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('نام محصول'),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('')
                    ->width(50)
                    ->height('auto')
                    ->label('عکس')
                    ->collection('products'),
                Tables\Columns\BooleanColumn::make('instock')
                    ->label('در انبار'),
                Tables\Columns\TextColumn::make('previous_price')
                    ->label('قیمت')
                    ->money('usd','dollar')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('today_price')
                    ->label('قیمت فروش')
                    ->money('usd','dollar'),
                Tables\Columns\TextColumn::make('description')
                    ->label('توضیحات')
                    ->limit(50)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('discount')
                    ->label('تخفیف')
                    ->suffix('%')
                    ->default(0),
                Tables\Columns\TextColumn::make('production_year')
                    ->label('محصول سال'),
                JalaliDateTimeColumn::make('created_at')
                    ->label('ساخته شده')
                    ->dateTime(),
                JalaliDateTimeColumn::make('updated_at')
                    ->label('بروز شده')
                    ->dateTime()
            ])->defaultSort('created_at', 'desc')
            ->filters([
                Filter::make('instock')
                    ->query(fn (Builder $query): Builder => $query->where('instock', 1))
                    ->label('در انبار')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProducts::route('/create'),
            'edit' => Pages\EditProducts::route('/{record}/edit'),
        ];
    }
    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
