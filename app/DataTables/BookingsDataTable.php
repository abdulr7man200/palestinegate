<?php

namespace App\DataTables;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Stays;
use App\Models\Cars;

class BookingsDataTable extends DataTable
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

                $editButton = '<button class="btn btn-sm btn-warning edit-data" data-id="' . $user->id . '"><i class="fas fa-edit"></i></button>';

                return $editButton ;
            })
            ->addColumn('user', function($row) {
                return $row->user->name ?? null;
            })
            ->addColumn('car', function($row) {
                return $row->car ? $row->car->type.' '.$row->car->model : null;
            })
            ->addColumn('stay', function($row) {
                return $row->stays ? $row->stays->name : null;
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Booking $model): QueryBuilder
    {
        $user = auth()->user();
        // $stay = Stays::where()
        if ($user->hasRole('admin')) {
            return $model->newQuery();
        } else {
            return $model->where('user_id', $user->id)->newQuery();
        }
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
            Column::make('user'),
            Column::make('stay'),
            Column::make('car'),
            Column::make('type'),
            Column::make('start_date'),
            Column::make('end_date'),
            Column::make('price'),
            Column::make('status'),
            Column::make('updated_at'),
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
        return 'Bookings_' . date('YmdHis');
    }
}
