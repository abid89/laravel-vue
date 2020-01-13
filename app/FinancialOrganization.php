<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinancialOrganization extends Model
{
    protected $fillable = array('name','short_name','address');

    // DEFINE RELATIONSHIPS ----------------
    public function bank_account() {
        return $this->belongsTo('App\BankAccount');
    }
}
