<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('records', function (Blueprint $table) {
            $table->string('category')->nullable()->after('name');
            $table->enum('type', ['income', 'expense'])->default('income')->after('amount');
        });
    }

    public function down()
    {
        Schema::table('records', function (Blueprint $table) {
            $table->dropColumn(['category', 'type']);
        });
    }
};

