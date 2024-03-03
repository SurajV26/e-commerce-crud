<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartyNamesTable extends Migration
{
    public function up()
    {
        Schema::create('party_names', function (Blueprint $table) {
            $table->id();
            $table->string('party_name', 255)->nullable();
            $table->string('location', 255)->nullable();
            $table->string('billing_name', 255)->nullable();
            $table->string('contact_person', 255)->nullable();
            $table->string('contact_number', 20)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('executive_name', 255)->nullable();
            $table->string('no_of_licenses', 255)->nullable();
            $table->date('amc_start_date')->nullable();
            $table->date('amc_expiry_date')->nullable();
            $table->string('past_amc_charge', 255)->nullable();
            $table->string('new_quoted_amc_charge', 255)->nullable();
            $table->enum('amc_status', ['active', 'expired'])->default('expired');
            $table->string('payment_status', 255)->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('party_names');
    }
    
}
