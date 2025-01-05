<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function ($user) {
            // Action for toggling active status
            $toggleActiveButton = $user->active
                ? '<button class="btn btn-sm btn-success toggle-active" data-id="' . $user->id . '"><i class="fas fa-toggle-on"></i></button>'
                : '<button class="btn btn-sm btn-secondary toggle-active" data-id="' . $user->id . '"><i class="fas fa-toggle-off"></i></button>';

            // Action for editing (returning data-id only)
            $editButton = '<button class="btn btn-sm btn-warning edit-data" data-id="' . $user->id . '"><i class="fas fa-edit"></i></button>';

            // Return the toggle button and edit button with data-id only
            return $editButton . ' ' . $toggleActiveButton;
        })
            ->addColumn('role', function ($user) {
                return $user->roles->pluck('name')->first() ?? 'N/A';
            })
            ->editColumn('active', function ($row) {
                return $row->active? 'Active' : 'InActive';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0, 'desc')
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('role'),
            Column::make('name'),
            Column::make('email'),
            Column::make('phone'),
            Column::make('date_of_birth'),
            Column::make('active'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
