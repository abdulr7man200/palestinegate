<?php

namespace App\DataTables;

use App\Models\ContactUs;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ContactDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($contact) {
                $deleteButton = '<button class="btn btn-sm btn-danger delete-data" data-id="' . $contact->id . '"><i class="fas fa-trash"></i></button>';
                return $deleteButton;
            })
            ->addColumn('user', function ($row) {
                return $row->user->name;
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ContactUs $model): QueryBuilder
    {
        $user = auth()->user();
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
            Column::make('name'),
            Column::make('email'),
            Column::make('phone'),
            Column::make('message'),
            Column::make('user'),
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
        return 'ContactUs_' . date('YmdHis');
    }
}
