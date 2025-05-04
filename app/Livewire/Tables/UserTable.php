<?php

namespace App\Livewire\Tables;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class UserTable extends PowerGridComponent
{
    public string $tableName = 'user-table-xqmnkb-table';

    public $listeners = ['refreshUserTable' => '$refresh'];

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        // Join users with sessions to get users who have sessions
        return User::leftJoin('sessions', 'users.id', '=', 'sessions.user_id')
            ->select(
                'users.*',
                'sessions.ip_address',
                DB::raw("CASE
                WHEN sessions.user_agent LIKE '%Chrome%' THEN 'Chrome'
                WHEN sessions.user_agent LIKE '%Firefox%' THEN 'Firefox'
                WHEN sessions.user_agent LIKE '%Safari%' AND sessions.user_agent NOT LIKE '%Chrome%' THEN 'Safari'
                WHEN sessions.user_agent LIKE '%Edge%' THEN 'Edge'
                WHEN sessions.user_agent LIKE '%Opera%' OR sessions.user_agent LIKE '%OPR%' THEN 'Opera'
                ELSE 'Other'
            END as user_agent"),
                DB::raw("FROM_UNIXTIME(sessions.last_activity, '%Y-%m-%d %H:%i:%s') as last_activity"),
                DB::raw("IF(sessions.id IS NULL, 'Inactivo', 'Activo') as estado"),
            );
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('email')
            ->add('ip_address')
            ->add('user_agent')
            ->add('last_activity')
            ->add('created_at')
            ->add('estado');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('IP Address', 'ip_address')
                ->sortable()
                ->searchable(),

            Column::make('User Agent', 'user_agent')
                ->sortable()
                ->searchable(),

            Column::make('Last Activity', 'last_activity')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::make('Estado', 'estado')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        // $this->js('alert(' . $rowId . ')');
        $this->dispatch('userUpdated', rowId: $rowId);
    }

    public function actions(User $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: ' . $row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }



    // public function actionRules($row): array
    // {
    //     return [
    //         // Hide button edit for ID 1
    //         // Rule::button('edit')
    //         //     ->when(fn($row) => $row->id === 1)
    //         //     ->hide(),
    //     ];
    // }
}
