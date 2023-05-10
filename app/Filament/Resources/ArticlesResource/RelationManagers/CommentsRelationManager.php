<?php

namespace App\Filament\Resources\ArticlesResource\RelationManagers;




use App\Models\User;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;


use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;

use Illuminate\Support\Facades\Auth;
use Laravelista\Comments\Comment;


class CommentsRelationManager extends RelationManager
{
    protected static ?string $pluralLabel = 'دیدگاه ها';

    protected static ?string $pluralModelLabel = 'دیدگاه ها';
    protected static string $relationship = 'comments';

    protected static ?string $recordTitleAttribute = 'comment';
    protected static ?string $modelLabel = 'دیدگاه';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('commenter_id')
                    ->options(User::all()->pluck('name', 'id'))
                    ->required()
                    ->label('کاربر')
                    ->searchable()
                    ->default(Auth::user()->id),
                MarkdownEditor::make('comment')

                    ->maxLength(255)

                    ->label('متن')
                ->columnSpan('full')
                    ->disableToolbarButtons([
                        'attachFiles',
                        'codeBlock',
                    ]),


                Toggle::make('approved')
                ->label('تائید شده')
                ->default(1),

                Hidden::make('commenter_type')
                    ->default('App\\Models\\User')
                    ->hiddenOn('edit'),

                Hidden::make('commentable_type')
                    ->default('App\\Models\\Articles')
                    ->hiddenOn('edit'),

                Hidden::make('commentable_id')
                    ->default(Comment::all()->pluck('user_id', 'id'))
                    ->hiddenOn('edit'),
                Hidden::make('updated_at')
                    ->default(now())
                    ->hiddenOn('create')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('comment')
                    ->label('متن'),
                Tables\Columns\TextColumn::make('commenter.name')
                ->label('کاربر'),
                BooleanColumn::make('approved')
                ->label('تائید شده')
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



    public function openSettingsModal(): void
    {
        $this->dispatchBrowserEvent('open-settings-modal');
    }
}
