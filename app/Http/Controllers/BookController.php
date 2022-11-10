<?php

namespace App\Http\Controllers;

use App\DataTables\BooksDataTable;
use App\Models\Book;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BooksDataTable $dataTable)
    {
        // $books = Book::all();

        // return view('books.index', [
        //     'books' => $books
        // ]);
        return $dataTable->render('books.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
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
            'judul' => 'required|unique:books,judul',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'jumlah_buku' => 'required|numeric',
            'deskripsi' => 'required'
        ]);

        try {
            $book = new Book();
            $book->judul = $request->post('judul');
            $book->pengarang = $request->post('pengarang');
            $book->penerbit = $request->post('penerbit');
            $book->tahun_terbit = $request->post('tahun_terbit');
            $book->jumlah_buku = $request->post('jumlah_buku');
            $book->deskripsi = $request->post('deskripsi');
            $book->gambar = '';
            $book->save();

            return redirect()->route('books.index')->with('success_message', 'Buku berhasil ditambahkan!');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->route('books.index')->with('error_message', 'Terjadi kesalaham. Buku gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('books.update');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('books.delete');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function generatePDF()
    {
        // return $dataTable->render('books.pdf');

        $mpdf = new \Mpdf\Mpdf();
        $html = '';
        $data = Book::limit(10)->get();
        return view('books.pdf', [
            'books' => $data
        ]);
        $html = view('books.pdf', [
            'books' => $data
        ]);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
