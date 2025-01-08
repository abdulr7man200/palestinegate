<?php

namespace App\DataTables;

use App\Models\Stays;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StaysDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($stay) {
                $editButton = '<button class="btn btn-sm btn-warning edit-data" data-id="' . $stay->id . '"><i class="fas fa-edit"></i></button>';
                $deleteButton = '<button class="btn btn-sm btn-danger delete-data" data-id="' . $stay->id . '"><i class="fas fa-trash"></i></button>';
                return $editButton . ' ' . $deleteButton;
            })
            ->editColumn('price', function ($row) {
                return '$' . number_format($row->price, 2);
            })
            ->editColumn('maxnumofguests', function ($row) {
                return $row->maxnumofguests . ' Guests';
            })
            ->addColumn('images', function ($row) {
                $images = $row->staysPics->map(function ($pic) {
                    $imageUrl = asset('storage/' . $pic->path);
                    return '<a href="' . $imageUrl . '" target="_blank">
                                <img src="' . $imageUrl . '" alt="Car Image" width="50" height="50" class="img-thumbnail">
                            </a>';
                })->join(' ');

                return $images;
            })
            ->rawColumns(['action', 'images'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Stays $model): QueryBuilder
    {
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            return $model->newQuery();
        } else {
            return $model->where('user_id', $user->id)->newQuery();
        }
    }

    /**
     * Optional method if you want to use the HTML builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'desc')
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('images'),
            Column::make('name'),
            Column::make('type'),
            Column::make('description'),
            Column::make('city'),
            Column::make('streetaddress'),
            Column::make('amenities'),
            Column::make('price'),
            Column::make('numberofbedrooms'),
            Column::make('maxnumofguests'),
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
        return 'Stays_' . date('YmdHis');
    }
}
