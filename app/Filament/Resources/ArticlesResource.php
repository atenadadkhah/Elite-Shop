<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticlesResource\Pages;
use App\Filament\Resources\ArticlesResource\RelationManagers\CommentsRelationManager;
use App\Models\Articles;
use Ariaieboy\FilamentJalaliDatetime\JalaliDateTimeColumn;
use Ariaieboy\FilamentJalaliDatetimepicker\Forms\Components\JalaliDatePicker;
use Filament\Forms;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

use bootstrap\Helper\Helper;
use Closure;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;



class ArticlesResource extends Resource
{

    protected static ?string $model = Articles::class;

    protected static ?string $pluralLabel = 'پست ها';

    protected static ?string $pluralModelLabel = 'پست ها';

    protected static ?string $recordTitleAttribute = 'subject';
    protected static ?string $navigationGroup = 'بلاگ';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'پست ها';

    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'مقاله';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Card::make()->schema([
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('subject')
                            ->reactive()
                            ->label('موضوع')
                            ->required()
                            ->maxLength(400)
                            ->afterStateUpdated(function (Closure $set, $state){
                                $set('slug', Helper::pslug($state));
                            }),
                        Forms\Components\TextInput::make('slug')->required()
                            ->label('اسلاگ')
                            ->minLength(5)
                            ->maxLength(430)
                            ->unique(ignoreRecord: true)
                    ]),
                    Forms\Components\MultiSelect::make('category_id')
                        ->relationship('category', 'title')
                        ->required()
                        ->label('دسته ها')
                        ->placeholder('دسته های مرتبط را انتخاب کنید'),
                    Forms\Components\MarkdownEditor::make('body')
                        ->required()
                        ->maxLength(65535)
                        ->label('محتوا'),
                    Grid::make()->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->label('نویسنده')
                            ->searchable()
                            ->default(Auth::user()->id),
                        JalaliDatePicker::make('created_at')
                            ->label('تاریخ انتشار')
                            ->required()
                            ->default(now()),
                    ]),

                ]),
                Section::make('تصویر')->schema([
                    Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                        ->disk('cloudinary')
                        ->image()
                        ->maxFiles(1)
                        ->label('')
                        ->collection('articles')

                ])->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject')
                    ->sortable()
                    ->searchable()
                    ->label('موضوع'),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('')
                    ->label('تصویر')
                    ->width(100)
                    ->height('auto')
                    ->collection('articles')
                    ,
                Tables\Columns\TextColumn::make('user.name')
                    ->label('نویسنده'),
                Tables\Columns\TextColumn::make('comments_count')
                    ->label('نظر ها')
                    ->counts('comments'),
                JalaliDateTimeColumn::make('created_at')
                    ->label('نوشته شده')
                    ->date(),
                JalaliDateTimeColumn::make('updated_at')
                    ->date()
                    ->label('بروز شده'),
            ])
            ->filters([
                SelectFilter::make('category')->relationship('category','title')
                ->label('دسته ها'),
                Filter::make('created_at')
                    ->form([
                        JalaliDatePicker::make('created_from')
                        ->label('تاریخ انتشار از'),
                        JalaliDatePicker::make('created_until')
                        ->label('تا'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
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
            CommentsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticles::route('/create'),
            'edit' => Pages\EditArticles::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

}
