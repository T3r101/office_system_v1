<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->string('payee_name')->after('user_id');
            $table->string('nature_of_payment')->after('payee_name');
            $table->string('cheque_number')->nullable()->after('nature_of_payment');
            $table->string('specific_fund')->after('cheque_number');
            $table->timestamp('deposit_date')->after('amount');
            $table->dropColumn(['source', 'notes', 'date']); // Remove old fields
        });
    }

    public function down()
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->dropColumn(['payee_name', 'nature_of_payment', 'cheque_number', 'specific_fund', 'deposit_date']);
            $table->string('source')->nullable();
            $table->text('notes')->nullable();
            $table->date('date');
        });
    }
};

