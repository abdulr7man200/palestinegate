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
                $userr = auth()->user();

                $recommendButton = '';

                $editButton = '<button class="btn btn-sm btn-warning edit-data" data-id="' . $stay->id . '"><i class="fas fa-edit"></i></button>';
                $deleteButton = '<button class="btn btn-sm btn-danger delete-data" data-id="' . $stay->id . '"><i class="fas fa-trash"></i></button>';

                if($userr->hasRole('admin')){
                    $recommendButton = '<button class="btn btn-sm ' . ($stay->is_recommended ? 'btn-success' : 'btn-secondary') . ' toggle-recommend" data-id="' . $stay->id . '">'
                    . '<i class="fas fa-star"></i> ' . ($stay->is_recommended ? 'Recommended' : 'Not Recommended') . '</button>';
                }

                return $editButton  . ' ' . $deleteButton . ' ' . $recommendButton;
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
            ->addColumn('mainpic', function ($row) {
                return '<a href="' . asset('storage/' . $row->main_pic) . '" target="_blank">
                    <img src="' . asset('storage/' . $row->main_pic) . '" alt="Car Image" width="50" height="50" class="img-thumbnail">
                </a>';
            })
            ->addColumn('banner', function ($row) {
                return '<a href="' . asset('storage/' . $row->banner) . '" target="_blank">
                    <img src="' . asset('storage/' . $row->banner) . '" alt="Car Image" width="50" height="50" class="img-thumbnail">
                </a>';
            })
            ->editColumn('availability', function ($row) {
                return $row->availability ? 'Available' : 'Not Available';
            })
            ->rawColumns(['action', 'images', 'banner', 'mainpic',])
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
            Column::make('mainpic'),
            Column::make('banner'),
            Column::make('name'),
            Column::make('type'),
            Column::make('description'),
            Column::make('city'),
            Column::make('streetaddress'),
            Column::make('price'),
            Column::make('numberofbedrooms'),
            Column::make('maxnumofguests'),
            Column::make('availability'),
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
