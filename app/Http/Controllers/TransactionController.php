<?php

namespace App\Http\Controllers;

use App\DataTables\TransactionsDataTable;
use App\Jobs\SendEmailJob;
use App\Models\Book;
use App\Models\Borrower;
use App\Models\Transaction;
use App\Models\TransactionBook;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TransactionsDataTable $dataTable)
    {
        return $dataTable->render('transactions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'peminjam' => 'required|numeric',
            'buku' => 'required|array|min:1|max:3',
            'tgl_pinjam' => 'required|date'
        ]);
        
        try {
            $borrower = Borrower::find($request->post('peminjam'));
            if (!$borrower) {
                throw new Exception('Peminjam dengan ID tersebut tidak ditemukan!');
            }

            $books = Book::whereIn('id', $request->post('buku'))->pluck('id');
            if (count($books) != count($request->post('buku'))) {
                throw new Exception('Salah satu/lebih ID buku tidak ditemukan!');
            }

            $date_return = date_create($request->post('tgl_pinjam'));
            date_add($date_return, date_interval_create_from_date_string('7 days'));
            $date_return = $date_return->format('Y-m-d');

            $transaction = new Transaction();
            DB::transaction(function() use ($request, $date_return, $transaction) {
                $transaction->borrower_id = $request->post('peminjam');
                $transaction->tanggal_pinjam = $request->post('tgl_pinjam');
                $transaction->tanggal_kembali = $date_return;
                $transaction->status = false;
                $transaction->save();

                $book_data = [];
                foreach ($request->post('buku') as $key => $value) {
                    array_push($book_data, ['transaction_id' => $transaction->id, 'book_id' => $value, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
                }
                TransactionBook::insert($book_data);
            });

            $emailJobs = new SendEmailJob($transaction->id);
            $this->dispatch($emailJobs);

            return redirect()->route('transactions.index')->with('success_message', 'Transaksi peminjaman berhasil dibuat!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('transactions.index')->with('error_message', 'Terjadi kesalaham. Transaksi gagal dibuat! Pesan: ' . $e->getMessage());
        }
    }

    public function return($id)
    {
        $transaction = Transaction::with(['books', 'borrower'])->find($id);
        // dd($book)
        return view('transactions.return', compact('transaction'));
    }

    public function finishTransaction(Request $request, $id)
    {
        $request->validate([
            'tgl_kembali' => 'required|date',
        ]);

        try {
            $transaction = Transaction::find($id);
            $transaction->tanggal_kembali = $request->post('tgl_kembali');
            $transaction->status = true;
            $transaction->save();

            return redirect()->route('transactions.index')
            ->with('success_message', 'Berhasil transaksi pengembalian.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('transactions.index')->with('error_message', 'Terjadi kesalaham. Transaksi pengembalian gagal.');
        }
    }

    public function detail($id)
    {
        $transaction = Transaction::with(['books', 'borrower'])->find($id);
        // dd($book)
        return view('transactions.detail', compact('transaction'));
    }
}
