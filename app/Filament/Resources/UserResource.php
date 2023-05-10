<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\OrdersRelationManager;
use App\Filament\Resources\UserResource\Widgets\StatsOverview;
use App\Filament\Resources\UserResource\Widgets\UserOverview;
use App\Models\Cities;
use App\Models\User;
use Ariaieboy\FilamentJalaliDatetime\JalaliDateTimeColumn;
use Ariaieboy\FilamentJalaliDatetimepicker\Forms\Components\JalaliDatePicker;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $pluralLabel = 'مشتریان';

    protected static ?string $pluralModelLabel = 'مشتریان';
    protected static ?string $navigationGroup = 'فروشگاه';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $modelLabel = 'کاربر';
    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'مشتریان';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)->schema([
                    Grid::make()->schema([
                        Card::make()->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->label('نام کامل')
                                ->regex('/^[a-zA-Zالف-ی]{2,}(?:\s[a-zA-Zالف-ی]+)+$/')
                                ->maxLength(255),
                            Forms\Components\TextInput::make('username')
                                ->required()
                                ->label('نام کاربری')
                                ->unique(ignoreRecord: true)
                                ->regex('/^(?=.*[الف-یA-Za-z])[الف-یA-Z0-9a-z-_.]{1,50}$/')
                                ->maxLength(256),
                            TextInput::make('email')
                                ->hiddenOn('edit')
                                ->columnSpan('full')
                                ->label('پست الکترونیکی')
                                ->required()
                                ->email()
                                ->columnSpan('full'),
                            Fieldset::make('اطلاعات اختیاری')
                                ->relationship('profile')
                                ->schema([
                                    TextInput::make('phone')
                                        ->label('شماره تماس')
                                        ->placeholder('وارد نشده')
                                        ->prefix('(98)+')
                                        ->numeric()
                                        ->startsWith(9)
                                        ->length(10)
                                        ->nullable()
                                        ,
                                    JalaliDatePicker::make('birth')
                                        ->label('تاریخ تولد')
                                        ->placeholder('وارد نشده')
                                        ->nullable(),
                                    Forms\Components\MarkdownEditor::make('about')
                                        ->label('درباره کاربر')
                                        ->maxLength(300)
                                        ->columnSpan('full')
                                        ->disableToolbarButtons(['attachFiles','codeBlock','orderedList','bulletList'])
                                        ->placeholder('درباره خودت بنویس...')
                                        ->nullable(),
                                    Select::make('country')
                                        ->label('شهر خود را انتخاب کنید')
                                        ->nullable()
                                        ->options(Cities::all()->pluck('name'))
                                        ->searchable()
                                        ->columnSpan('full')
                                        ->placeholder('وارد نشده')
                                        ->nullable()
                                ]),
                            TextInput::make('password')
                                ->password()
                                ->regex('/^(?=\P{L}*\p{L})(?=\P{N}*\p{N})(?=[\p{L}\p{N}]*[^\p{L}\p{N}])[\s\S]{8,}$/')
                                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                                ->hiddenOn('edit')
                                ->columnSpan('full')
                                ->label('رمز عبور')
                                ->required(),
                            Hidden::make('email_verified_at')
                                ->default(now())
                                ->hiddenOn('edit')

                        ])->columns(),

                    ])->columnSpan(2),
                    Grid::make()->schema([
                        Section::make('آواتار')->schema([
                            Forms\Components\SpatieMediaLibraryFileUpload::make('profiles.image')
                                ->avatar()
                                ->disk('cloudinary')
                                ->image()
                                ->maxFiles(1)
                                ->collection('avatars')
                        ]),

                    ])->columnSpan(1),

                ]),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('نام کامل')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('')
                    ->rounded()
                    ->width(45)
                    ->height(45)
                    ->label('آواتار')
                    ->collection('avatars'),
                Tables\Columns\TextColumn::make('username')
                    ->label('نام کاربری')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('ایمیل')
                    ->searchable()
                    ->sortable(),
                JalaliDateTimeColumn::make('created_at')
                    ->date()
                    ->label('ساخته شده'),
                JalaliDateTimeColumn::make('updated_at')
                    ->date()
                    ->label('بروز شده'),
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
            OrdersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            UserOverview::class,
        ];
    }
}
