<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogRequestEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_request_entries', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('host');
            $table->string('method');
            $table->string('action');
            $table->string('status');
            $table->text('request_body');
            $table->text('response_body');
            $table->foreignId('user_id')->nullable();
            $table
                ->string('device')
                ->nullable()
                ->comment('機種');
            $table
                ->string('device_brand')
                ->nullable()
                ->comment('機種メーカー');
            $table
                ->string('platform')
                ->nullable()
                ->comment('OS');
            $table
                ->string('platform_version')
                ->nullable()
                ->comment('OSバージョン');
            $table
                ->string('package_name')
                ->nullable()
                ->comment('パッケージ');
            $table
                ->string('package_version')
                ->nullable()
                ->comment('パッケージバージョン');
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
        Schema::dropIfExists('log_request_entries');
    }
}
