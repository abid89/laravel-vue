<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use SoftDeletes;

    protected $fillable = ['financial_organization_id', 'account_name', 'account_no', 'branch', 'account_type', 'swift_code', 'route_no'];

    //uses for soft delete
    protected $dates = ['deleted_at'];

    public function financial_organization() {
        return $this->hasOne('App\FinancialOrganization', 'id', 'financial_organization_id'); // this matches the Eloquent model
    }
}
