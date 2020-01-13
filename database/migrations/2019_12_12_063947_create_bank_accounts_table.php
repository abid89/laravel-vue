<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->smallInteger('financial_organization_id')->comment('Bank table primary id');
            $table->bigInteger('store_id')->nullable();
            $table->string('account_name');
            $table->string('account_no',100)->nullable()->unique();
            $table->string('branch',50)->nullable();
            $table->boolean('account_type')->nullable()->comment('1 = Saving Account, 2 = Current Account, 3 = Join Account');
            $table->string('swift_code',100)->nullable();
            $table->string('route_no',100)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_accounts');
    }
}
