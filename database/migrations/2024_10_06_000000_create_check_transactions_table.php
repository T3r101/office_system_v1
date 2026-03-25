<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('check_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('check_no')->unique();
            $table->string('nature_of_payment');
            $table->enum('specific_fund', ['GENERAL FUND PROPER', 'TRUST FUND', 'OTHER']);
            $table->decimal('amount', 12, 2);
            $table->dateTime('date');
            $table->string('office');
            $table->string('account_code');
            $table->enum('fund_type', ['CURRENT', 'PRIOR']);
            $table->string('payee_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('check_transactions');
    }
};

