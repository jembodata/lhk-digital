<?php

namespace App\Livewire;

use App\Models\Porg_Data;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class PorgList extends PowerGridComponent
{
    public string $tableName = 'porg-list-ikxtgm-table';

    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),

            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),

            PowerGrid::lazy()
                ->rowsPerChildren(10),
        ];
    }

    // public function datasource(): Builder
    // {
    //     return DB::table('porg__data');
    // }

    public function datasource(): Builder
    {
        $query = DB::table('porg__data')
            ->join('users', 'porg__data.user_id', '=', 'users.id')
            ->where('porg__data.user_id', auth()->id())
            ->select('porg__data.*', 'users.name as user_name');  // Alias for the user's name

        // Debugging the SQL query to see if it's correct
        // dd($query->toSql());

        return $query;
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('created_at')
            ->add('created_at_formatted', function ($dish) {
                return Carbon::parse($dish->created_at)->format('d/m/Y H:i'); //20/01/2024 10:05
            })
            ->add('updated_at')
            ->add('user_name')
            ->add('nama_plant')
            ->add('tipe_proses')
            ->add('nama_mesin')
            ->add('nama_foreman')
            ->add('no_op')
            ->add('type_size')
            ->add('nama_operator')
            ->add('bahan_material')
            ->add('hour_meter')
            ->add('actual_output')
            ->add('target_output')
            ->add('nama_customer')
            ->add('Status');
    }

    public function columns(): array
    {
        return [
            // Column::make('Id', 'id'),
            // Column::make('Created at', 'created_at_formatted', 'created_at')
            //     ->sortable(),

            Column::make('Created at', 'created_at_formatted')
                ->sortable()
                ->searchable(),

            Column::make('Nama foreman', 'nama_foreman')
                ->sortable()
                ->searchable(),

            Column::make('Nama operator', 'nama_operator')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'Status')
                ->sortable()
                ->searchable(),

            // Column::make('Updated at', 'updated_at_formatted', 'updated_at')
            //     ->sortable(),

            // Column::make('Updated at', 'updated_at')
            //     ->sortable()
            //     ->searchable(),

            // Column::make('Nama User Login', 'user_name'),
            Column::make('Nama plant', 'nama_plant')
                ->sortable()
                ->searchable(),

            Column::make('Tipe proses', 'tipe_proses')
                ->sortable()
                ->searchable(),

            Column::make('Nama mesin', 'nama_mesin')
                ->sortable()
                ->searchable(),

            Column::make('No op', 'no_op')
                ->sortable()
                ->searchable(),

            Column::make('Type size', 'type_size')
                ->sortable()
                ->searchable(),

            Column::make('Bahan material', 'bahan_material')
                ->sortable()
                ->searchable(),

            Column::make('Hour meter', 'hour_meter')
                ->sortable()
                ->searchable(),

            Column::make('Actual output', 'actual_output')
                ->sortable()
                ->searchable(),

            Column::make('Target output', 'target_output')
                ->sortable()
                ->searchable(),

            Column::make('Nama customer', 'nama_customer')
                ->sortable()
                ->searchable(),

            // Column::action('Action'),

        ];
    }

    public function filters(): array
    {
        return [];
    }

    // #[\Livewire\Attributes\On('edit')]
    // public function edit($rowId): void
    // {
    //     $this->js('alert(' . $rowId . ')');
    // }

    // public function actions($row): array
    // {
    //     return [
    //         Button::add('edit')
    //             ->slot('Edit: ' . $row->id)
    //             ->id()
    //             ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
    //             ->dispatch('edit', ['rowId' => $row->id])
    //     ];
    // }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
