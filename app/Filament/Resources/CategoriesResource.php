<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriesResource\Pages;
use App\Models\Categories;

use bootstrap\Helper\Helper;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;


class CategoriesResource extends Resource
{
    protected static ?string $model = Categories::class;

    protected static ?string $pluralLabel = 'دسته بندی پست ها';

    protected static ?string $pluralModelLabel = 'دسته بندی پست ها';
    protected static ?string $navigationGroup = 'بلاگ';

    protected static ?string $navigationIcon = 'heroicon-o-printer';

    protected static ?string $navigationLabel = 'دسته بندی پست ها';
    protected static ?string $modelLabel = 'دسته بندی مقاله';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
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
            'index' => Pages\ListCategories::route('/'),
        ];
    }
}
