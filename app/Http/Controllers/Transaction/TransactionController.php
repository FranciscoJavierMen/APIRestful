<?php

namespace APIRestful\Http\Controllers\Transaction;

use APIRestful\Transaction;
use Illuminate\Http\Request;
use APIRestful\Http\Controllers\APIController;

class TransactionController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();

        return $this->showAll($transactions);
    }


    //Función para retornar la instancia de Transaction
    public function show(Transaction $transaction)
    {
        return $this->showone($transaction);
    }

}
