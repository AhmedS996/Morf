<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\PostResource\Pages;
use App\Filament\App\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-on-square';

    protected static ?string $navigationGroup = 'Posts information';

    protected static ?string $navigationLabel = 'My Posts';

    protected static ?int $navigationSort = 1;


    public static function getNavigationBadge(): string
    {
        $user = Auth::user();
        $userId = $user->id;

        // Count the comments for the current user
        $commentCount = static::getModel()::where('user_id', $userId)->count();

        return (string)$commentCount;
    }

    public static function form(Form $form): Form
    {
        $user = Auth::user();
        $userId = $user->id;
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->default($userId)
                ->disabled(true)
                ->required(),
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),
            Forms\Components\Textarea::make('content')
                ->required()
                ->maxLength(65535)
                ->columnSpanFull(),
            ])->columns([
                // Add the created_at and updated_at fields here
                Forms\Components\DateTimePicker::make('created_at')->default(now())->hidden(),
                Forms\Components\DateTimePicker::make('updated_at')->default(now())->hidden(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $user = Auth::user();
        $userId = $user->id;
        return $table
        ->modifyQueryUsing(function (Builder $query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->columns([
            Tables\Columns\TextColumn::make('user.name')
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('title')
                ->searchable(),
            Tables\Columns\TextColumn::make('content')
                ->sortable(),
            Tables\Columns\TextColumn::make('like')
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('view')
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
