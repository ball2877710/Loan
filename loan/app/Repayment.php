<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    protected $fillable = [
       'date', 'paymentAmount', 'principle', 'interest', 'balance'
    ];
}
