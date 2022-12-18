<?php

namespace App\DataTables;

use App\Models\Transaction;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TransactionsDataTable extends DataTable
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
            ->addColumn('action', function ($row) {
                $actionButton = '<a href="' . route('transactions.return', $row) . '" class="btn btn-info mb-2 mb-xl-0">
                                    <i class="fas fa-check-square mr-1"></i>
                                    Pengembalian
                                </a>';

                return $actionButton;
            })
            ->editColumn('nama_peminjam', function (Transaction $transaction) {
                return $transaction->borrower->nama_peminjam;
            })
            ->editColumn('status', function(Transaction $transaction) {
                if ($transaction->status == true) {
                    $badge = '<span class="badge bg-success text-bg-success">Dikembalikan</span>';
                } else {
                    $badge = '<span class="badge bg-warning text-bg-warning">Dalam peminjaman</span>';
                }

                return $badge;
            })
            ->editColumn('action', function(Transaction $transaction) {
                if ($transaction->status == false) {
                    $actionButton = '<a href="' . route('transactions.return', $transaction->id) . '" class="btn btn-info mb-2 mb-xl-0">
                        <i class="fas fa-check-square mr-1"></i>
                        Pengembalian
                        </a>';
                } else {
                    $actionButton = '<a href="' . route('transactions.detail', $transaction->id) . '" class="btn btn-info mb-2 mb-xl-0">
                        <i class="fas fa-info mr-1"></i>
                        Detail
                        </a>';
                }

                return $actionButton;
            })
            ->rawColumns(['status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Transaction $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transaction $model)
    {
        return $model->newQuery()->with('borrower');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('transactions-table')
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
            Column::make('nama_peminjam'),
            Column::make('status'),
            Column::make('tanggal_pinjam'),
            Column::make('tanggal_kembali'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(350)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Transactions_' . date('YmdHis');
    }
}
