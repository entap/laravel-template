<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagerTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('package_releases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained();
            $table->string('version');
            $table->string('uri')->nullable();
            $table->dateTime('publish_date');
            $table->dateTime('expire_date');
            $table->timestamps();

            $table->unique(['package_id', 'version']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_releases');
        Schema::dropIfExists('packages');
    }
}
