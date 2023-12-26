<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Orchid\Support\Facades\Layout;

use Orchid\Screen\{
    Actions\Link,
    Screen
};

class PlatformScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Index';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Welcome to your Anecdoctor admin.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Link::make('Link to the jokes list')
                    ->icon('bs.link-45deg')
                    ->route('platform.jokes.list'),
            ])
        ];
    }
}
