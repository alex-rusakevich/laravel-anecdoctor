<?php

namespace App\Orchid\Layouts;

use App\Models\Joke;

use Orchid\Screen\{
    Actions\Link,
    Layouts\Table,
    TD
};

class JokesTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'jokes';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('edit', 'Edit')
                ->sort()
                ->render(function (Joke $joke) {
                    return Link::make('')
                        ->icon('bs.pencil-fill')
                        ->route('platform.joke.edit', [$joke]);
                }),
            TD::make('id')->sort(),
            TD::make('title'),
            TD::make('body')->width('450px'),
            TD::make('source'),
        ];
    }
}
