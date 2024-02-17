<?php

namespace App\Orchid\Screens;

use App\Models\Group;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class GroupScreen extends Screen
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
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'GroupScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Add modal')
            ->modal('groupModal')
            ->method('create')
            ->icon('plus'),
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
            Layout::modal('groupModal', Layout::rows([
                Input::make('group.name')
                    ->title('Guruh nomini kiriting')
                    ->placeholder('group')
                    ->help('Yangi guruh qo\'shish'),
            ]))
                ->title('Create Group')
                ->applyButton('Add Group'),
        ];
    }

    public function create(Request $request) {
        $request->validate(
            ['group.name'=>'required',]
        );
        $group = new Group();
        $group->name = $request->input('group.name');
        $group->save();
    }
}
