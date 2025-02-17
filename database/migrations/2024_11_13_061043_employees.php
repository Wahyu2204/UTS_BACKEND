<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('employees')) {
            Schema::create('employees', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->char('gender', 1);
                $table->string('phone');
                $table->text('address');
                $table->string('email');
                $table->string('status');
                $table->date('hired_on');
                $table->timestamps();
            });
        }        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {

    }
};