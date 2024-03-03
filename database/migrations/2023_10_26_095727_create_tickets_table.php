<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('institue_name');
            $table->string('mobile');
            $table->string('product');
            $table->string('issue');
            $table->string('attachment');
            $table->string('assigned_to');
            $table->string('priority');
            $table->string('ticket_status')->default('open');
            $table->timestamps();

            $table->unsignedBigInteger('user_id'); // Add this line to create the user_id column
            $table->foreign('user_id')->references('id')->on('users'); // Assuming users table is related to tickets
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
