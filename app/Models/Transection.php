<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transection extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function getCustomer(){
        return $this->belongsTo('App\Models\Ledger', 'ledger_id', 'id');
    }

    public function getInvoiceItems(){
        return $this->hasMany('App\Models\Invoice_item', 'transection_id', 'id');
    }
}
