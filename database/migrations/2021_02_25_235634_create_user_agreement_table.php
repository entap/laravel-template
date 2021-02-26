<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAgreementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_agreement', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('agreement_id')->constrained();
            $table->timestamps();

            $table->index(['user_id', 'agreement_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_agreement');
    }
}
