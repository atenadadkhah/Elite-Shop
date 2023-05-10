<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FAQResource\Pages;

use App\Models\FAQ;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;


class FAQResource extends Resource
{
    protected static ?string $model = FAQ::class;

    protected static ?string $pluralLabel = 'پرسش و پاسخ';

    protected static ?string $pluralModelLabel = 'پرسش و پاسخ';
    protected static ?string $navigationGroup = 'فروشگاه';

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationLabel = 'پرسش و پاسخ';
    protected static ?string $modelLabel = 'پرسش و پاسخ';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    Forms\Components\TextInput::make('question')
                        ->label('سوال')
                        ->required()
                        ->minLength(5)
                        ->maxLength(200),
                    Forms\Components\MarkdownEditor::make('answer')->required()
                        ->label('جواب')
                        ->minLength(3)
                        ->maxLength(400)
                        ->disableToolbarButtons([
                            'attachFiles',
                            'codeBlock',
                            'orderedList',
                            'bulletList'
                        ])
                ->columnSpan('full')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question')
                    ->label('سوال')
                    ->searchable(),
                Tables\Columns\TextColumn::make('answer')
                    ->label('جواب')
                    ->limit(50)
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
            'index' => Pages\ListFAQS::route('/'),
        ];
    }
}
