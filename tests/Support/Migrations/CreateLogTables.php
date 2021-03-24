<?php
namespace Tests\Support\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogTables extends Migration
{
    public function up()
    {
        Schema::create('log_xxx_entries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::create('log_yyy_entries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        // Not log
        Schema::create('zzz_entries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_xxx_entries');
        Schema::dropIfExists('log_yyy_entries');
        Schema::dropIfExists('zzz_entries');
    }
}
