<?php

namespace App\Orchid\Screens;

use App\Models\Group;
use App\Models\Task;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class TaskScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
             'tasks' => Task::latest()->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Task';
    }

    public function description(): ?string
    {
        return 'Bu yangi Task';
    }
    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Add Task')
                ->modal('taskModal')
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
            Layout::table('tasks', [
                TD::make('id'),
                TD::make('group'),
                TD::make('employee'),
                TD::make('body'),
            ]),

            Layout::modal('taskModal', Layout::rows([
                Relation::make('group')
                    ->fromModel(Group::class, 'name')
                    ->title('Gruhni tanlang'),

                Input::make('task.employee')
                    ->title('Hodimni Kiriting')
                    ->placeholder('Hodim')
                    ->help('Ishni bajaradigan hodimni ismini kiriting'),

                TextArea::make('task.body')
                    ->title('Task Body')
                    ->placeholder('Enter Body')
                    ->help('Bajariladigan vazifani yozing!'),
            ]))
                ->title('Create Task')
                ->applyButton('Add Task'),
        ];
    }

    public function create(Request $request)
    {
        $request->validate([
            'group' => 'required',
            'task.employee' => 'required|max:255',
            'task.body' => 'required|max:500',
        ]);
        $task = new Task();
        $task->employee = $request->input('task.employee');
        $task->group_id = $request->input('group');
        $task->body = $request->input('task.body');
        $task->save();
    }
}
