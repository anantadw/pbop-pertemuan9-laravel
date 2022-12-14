<?php

namespace App\DataTables;

use App\Models\Book;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BooksDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($row) {
                $actionButton = '<a href="' . route('books.show', $row) . '" class="btn btn-info mb-2 mb-xl-0">
                                    <i class="fas fa-info mr-1"></i>
                                    Detail
                                </a>
                                <a href="' . route('books.edit', $row) . '" class="btn btn-warning mb-2 mb-xl-0">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </a>
                                <form action="' . route('books.destroy', $row) . '" method="POST" class="d-inline">
                                    <input type="hidden" name="_token" value=" ' . csrf_token() . ' ">
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" class="btn btn-danger mb-2 mb-xl-0">
                                        <i class="fas fa-trash mr-1"></i>
                                        Delete
                                    </button>
                                </form>';

                return $actionButton;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Book $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Book $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('books-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->orderBy(0);
                    // ->buttons(
                    //     Button::make('create'),
                    //     Button::make('export'),
                    //     Button::make('print'),
                    //     Button::make('reset'),
                    //     Button::make('reload')
                    // );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('judul'),
            Column::make('pengarang'),
            Column::make('tahun_terbit'),
            Column::make('jumlah_buku'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(350)
                  ->addClass('text-center'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Books_' . date('YmdHis');
    }
}
