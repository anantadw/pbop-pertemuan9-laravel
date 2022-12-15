<?php

namespace App\Http\Controllers;

use App\Jobs\TestSendEmail;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TestQueueEmails extends Controller
{
    public function sendTestEmails(Transaction $transaction, $destination)
    {
        $emailJobs = new TestSendEmail($transaction, $destination);
        $this->dispatch($emailJobs);
    }
}
