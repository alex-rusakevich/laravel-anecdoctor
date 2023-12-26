<?php

namespace App\Orchid\Screens;

use App\Models\Joke;
use Illuminate\Http\Request;

use Orchid\Screen\{
    Actions\Button,
    Fields\Input,
    Fields\TextArea,
    Screen
};
use Orchid\Support\Facades\{
    Alert,
    Layout
};

class JokeEditScreen extends Screen
{
    public $joke;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Joke $joke): iterable
    {
        return ['joke' => $joke];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Jokes Edit Screen';
    }

    public function description(): ?string
    {
        return 'Jokes editing and creating screen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create a joke')
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->joke->exists),

            Button::make('Update')
                ->icon('bs.pencil-square')
                ->method('createOrUpdate')
                ->canSee($this->joke->exists),

            Button::make('Remove')
                ->icon('bs.trash')
                ->method('remove')
                ->canSee($this->joke->exists),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('joke.title')
                    ->title('Title')
                    ->placeholder('***'),

                TextArea::make('joke.body')
                    ->title('Main text')
                    ->rows(15),

                Input::make('joke.source')
                    ->title('Source')
                    ->placeholder('Attractive but mysterious title')
            ])
        ];
    }

    public function createOrUpdate(Joke $joke, Request $request)
    {
        $joke->fill($request->get('joke'))->save();

        Alert::info('You have successfully created a joke.');

        return redirect()->route('platform.jokes.list');
    }

    /**
     * @param Joke $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Joke $joke)
    {
        $joke->delete();

        Alert::info('You have successfully deleted the joke.');

        return redirect()->route('platform.jokes.list');
    }
}
