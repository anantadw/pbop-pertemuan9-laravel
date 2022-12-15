<?php

namespace App\Http\Controllers;

use App\DataTables\TransactionsDataTable;
use App\Jobs\TestSendEmail;
use App\Models\BorrowedBook;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            'peminjam' => 'required|regex:/^[a-zA-Z.\s]*$/|string|min:4',
            'nik' => 'required|numeric|digits:16',
            'nim' => 'nullable|numeric|digits:9',
            'email' => 'required|email',
            'nomor_telepon' => 'required|numeric|digits_between:10,13',
            'buku' => 'required|array|min:1|max:3',
            'tgl_pinjam' => 'required|date'
        ]);
        
        try {
            $date_return = date_create($request->post('date'));
            date_add($date_return, date_interval_create_from_date_string('7 days'));
            $date_return = $date_return->format('Y-m-d');

            $transaction = new Transaction();
            $transaction->nama_peminjam = $request->post('peminjam');
            $transaction->nim = $request->post('nim');
            $transaction->nik = $request->post('nik');
            $transaction->email = $request->post('email');
            $transaction->nomor_telepon = $request->post('nomor_telepon');
            $transaction->status = false;
            $transaction->tanggal_pinjam = $request->post('tgl_pinjam');
            $transaction->tanggal_kembali = $date_return;
            $transaction->save();

            $book_data = [];
            foreach ($request->post('buku') as $key => $value) {
                array_push($book_data, ['transaction_id' => $transaction->id, 'book_id' => $value, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            }
            BorrowedBook::insert($book_data);

            $emailJobs = new TestSendEmail($transaction);
            $this->dispatch($emailJobs);

            return redirect()->route('transactions.index')->with('success_message', 'Transaksi peminjaman berhasil dibuat!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('transactions.index')->with('error_message', 'Terjadi kesalaham. Transaksi gagal dibuat!');
        }
    }

    public function return($id)
    {
        $transaction = Transaction::with(['books'])->find($id);
        // dd($book)
        return view('transactions.return', compact('transaction'));
    }

    public function finishTransaction(Request $request, $id)
    {
        $request->validate([
            'tgl_dikembalikan' => 'required',
        ]);

        try {
            $transaction = Transaction::find($id);
            $transaction->tanggal_dikembalikan = $request->post('tgl_dikembalikan');
            $transaction->status = true;
            $transaction->save();

            return redirect()->route('transactions.index')
            ->with('success_message', 'Berhasil transaksi pengembalian.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('transactions.index')->with('error_message', 'Terjadi kesalaham. Transaksi pengembalian gagal.');
        }
    }
}
