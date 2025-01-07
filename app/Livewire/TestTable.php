<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Porg_Data;
use Illuminate\Support\Facades\Auth;

class TestTable extends DataTableComponent
{
    protected $model = Porg_Data::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("id", "id")
                ->sortable(),
            Column::make('nama plant', 'nama_plant'),
            Column::make('tipe proses', 'tipe_proses'),
            Column::make('Mesin', 'nama_mesin'),
            Column::make('Operator', 'nama_operator'),
            Column::make('Status', 'Status'),
        ];
    }
}
