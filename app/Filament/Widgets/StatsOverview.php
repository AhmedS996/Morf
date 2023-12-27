<?php

namespace App\Filament\Widgets;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            $this->createStat('Total Users', User::class),
            $this->createStat('Total Posts published', Post::class),
            $this->createStat('Total Comments', Comment::class),
        ];
    }

    // Helper method to create a Stat instance
    protected function createStat($label, $modelClass)
    {
        $count = $modelClass::query()->count();

        return Stat::make($label, $count)
            ->description($this->getDescription($count))
            ->descriptionIcon($this->getDescriptionIcon($count))
            ->color($this->getColor($count));
    }

    // Helper methods
    protected function getDescription($count)
    {
        if ($count > 100) {
            return 'High count';
        } elseif ($count > 50) {
            return 'Medium count';
        } else {
            return 'Low count';
        }
    }

    protected function getDescriptionIcon($count)
    {
        // Customize description icon based on the count
        // Example: You can set different icons for different count ranges
        if ($count > 100) {
            return 'heroicon-m-arrow-trending-up';
        } elseif ($count > 50) {
            return 'heroicon-o-arrow-right';
        } else {
            return 'heroicon-o-arrow-trending-down';
        }
    }

    protected function getColor($count)
    {
        // Customize color based on the count
        // Example: You can set different colors for different count ranges
        if ($count > 100) {
            return 'success';
        } elseif ($count > 50) {
            return 'info';
        } else {
            return 'danger';
        }
    }
}
