<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Post;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

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
            ->badge(Post::query()->count()),
        'This Week' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subWeek()))
            ->badge(Post:: query()->where('created_at', '>=', now()->subWeek())->count()),
        'This Month' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
            ->badge(Post:: query()->where('created_at', '>=', now()->subMonth())->count()),
        'This Year' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subYear()))
            ->badge(Post:: query()->where('created_at', '>=', now()->subYear())->count()),
        ];
    }
}
