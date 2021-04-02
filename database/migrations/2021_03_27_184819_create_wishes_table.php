<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reference_code');
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->float('amount', 8, 2);
            $table->longText('description');
            $table->string('status')->default('Pending');
            $table->string('grant_name')->nullable();
            $table->string('grant_email')->nullable();
            $table->string('grant_phone_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishes');
    }
}
