<?php

namespace App\Filament\App\Widgets;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();
        $userId = $user->id;

        // Retrieve statistics from the database
        $totalPostsViews = Post::where('user_id', $userId)->sum('view');
        $totalPostsPublished = Post::where('user_id', $userId)->count();
        $totalComments = Comment::where('user_id', $userId)->count();

        return [
            Stat::make('Total Posts views', $totalPostsViews)
                ->description($this->getDescription($totalPostsViews))
                ->descriptionIcon($this->getDescriptionIcon($totalPostsViews))
                ->color($this->getColor($totalPostsViews)),
            Stat::make('Total Posts published', $totalPostsPublished)
                ->description($this->getDescription($totalPostsPublished))
                ->descriptionIcon($this->getDescriptionIcon($totalPostsPublished))
                ->color($this->getColor($totalPostsPublished)),
            Stat::make('Total Comments', $totalComments)
                ->description($this->getDescription($totalComments))
                ->descriptionIcon($this->getDescriptionIcon($totalComments))
                ->color($this->getColor($totalComments)),
        ];
    }

    // Helper methods
    protected function getDescription($count)
    {

        if ($count > 50) {
            return 'High count';
        } elseif ($count > 7) {
            return 'Medium count';
        } else {
            return 'Low count';
        }
    }

    protected function getDescriptionIcon($count)
    {
        // Customize description icon based on the count
        // Example: You can set different icons for different count ranges
        if ($count > 50) {
            return 'heroicon-m-arrow-trending-up';
        } elseif ($count > 7) {
            return 'heroicon-o-arrow-right';
        } else {
            return 'heroicon-o-arrow-trending-down';
        }
    }

    protected function getColor($count)
    {
        // Customize color based on the count
        // Example: You can set different colors for different count ranges
        if ($count > 50) {
            return 'success';
        } elseif ($count > 7) {
            return 'info';
        } else {
            return 'danger';
        }
    }
}
