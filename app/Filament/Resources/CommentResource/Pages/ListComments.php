<?php

namespace App\Filament\Resources\CommentResource\Pages;

use App\Filament\Resources\CommentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Comment;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListComments extends ListRecords
{
    protected static string $resource = CommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs():array
    {
        return[
            'All' => Tab::make()
                ->badge(Comment::query()->count()),
            'This Week' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subWeek()))
                ->badge(Comment:: query()->where('created_at', '>=', now()->subWeek())->count()),
            'This Month' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
                ->badge(Comment:: query()->where('created_at', '>=', now()->subMonth())->count()),
            'This Year' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subYear()))
                ->badge(Comment:: query()->where('created_at', '>=', now()->subYear())->count()),
        ];
    }
}
