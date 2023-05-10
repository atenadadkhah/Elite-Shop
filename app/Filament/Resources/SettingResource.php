<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Ariaieboy\FilamentJalaliDatetime\JalaliDateTimeColumn;
use Ariaieboy\FilamentJalaliDatetimepicker\Forms\Components\JalaliDateTimePicker;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;


    protected static ?string $pluralLabel = 'عمومی';

    protected static ?string $pluralModelLabel = 'تنظیمات عمومی';

    protected static ?string $navigationIcon = 'heroicon-o-adjustments';
    protected static ?string $navigationGroup = 'تنظیمات';
    protected static ?string $navigationLabel = 'عمومی';
    protected static ?string $modelLabel = 'تنظیمات عمومی';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)->schema([
                    Grid::make()->schema([
                        Card::make()->schema([
                            TextInput::make('title')
                                ->reactive()
                                ->label('عنوان سایت')
                                ->required()
                                ->maxLength(100),
                            Textarea::make('description')
                                ->label('توضیحات سایت')
                                ->required()
                                ->maxLength(60)
                                ->helperText('سعی کنید در توضیحات سایت خود از کلمات کلیدی سایت استفاده نمایید.'),
                            TextArea::make('address')
                                ->label('آدرس شما')
                                ->required()
                                ->maxLength(100),
                        ]),
                        Section::make('شبکه های اجتماعی فعال')
                            ->schema([
                                Repeater::make('social_media')
                                    ->label('شبکه های اجتماعی')
                                    ->schema([
                                        Grid::make()->schema([
                                            Select::make('media')
                                                ->label('نوع لینک')
                                                ->options([
                                                    'blog' => 'بلاگ',
                                                    'video' => 'ویدئو',
                                                    'telegram' => 'تلگرام',
                                                    'vimeo' => 'Vimeo',
                                                    'stackoverflow' => 'Stack Overflow',
                                                    'github' => 'GitHub',
                                                    'linkedin' => 'Linkedin',
                                                    'gitlab' => 'GitLab',
                                                    'twitter' => 'Twitter',
                                                    'facebook' => 'Facebook',
                                                    'instagram' => 'Instagram',
                                                ])->searchable(),
                                            TextInput::make('url')
                                                ->label('آدرس اینترنتی')
                                                ->url()
                                        ]),

                                    ])->collapsible()
                                    ->maxItems(11)
                            ])
                    ])->columnSpan(2),
                    Grid::make(1)->schema([
                        Section::make('ارتباطات')
                        ->schema([
                            TextInput::make('contact.phone')
                            ->label('شماره اصلی')
                                ->length(10)
                            ->numeric()
                            ->prefix('(98+)'),
                            Repeater::make('contact.email')
                                ->label('ایمیل ها')
                                ->schema([
                                    TextInput::make('email')
                                        ->label('ایمیل')
                                    ->email(),
                                    ])
                                ->collapsible()
                                ->maxItems(4),
                            Repeater::make('contact.call')
                                ->label('سایر شماره تماس ها')
                                ->schema([
                                    TextInput::make('call')
                                        ->label('شماره تماس')
                                        ->numeric(),
                                ])
                                ->collapsible()
                                ->maxItems(4),

                        ]),
                        Section::make('تخفیف سراسری')
                        ->schema([
                            JalaliDateTimePicker::make('discount')
                            ->label('تخفیف سراسری تا')
                        ])
                    ])->columnSpan(1)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('عنوان سایت'),
                Tables\Columns\TextColumn::make('contact.phone')
                    ->label('تلفن اصلی')
                    ->suffix('(98+) '),
                Tables\Columns\TextColumn::make('contact.email.0.email')
                    ->label('ایمیل ها')
                    ->limit(30),
                Tables\Columns\TextColumn::make('description')
                    ->label('توضیحات سایت')
                    ->limit(50),
                Tables\Columns\TextColumn::make('address')
                    ->label('آدرس')
                    ->limit(70),
                JalaliDateTimeColumn::make('discount')
                    ->label('تخفیف سراسری تا')
                    ->default('وارد نشده')
                    ->dateTime(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }

    public static function canCreate() : bool
    {
        return false;
    }

}
