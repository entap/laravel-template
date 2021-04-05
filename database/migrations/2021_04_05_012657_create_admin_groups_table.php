<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->nestedSet();
            $table->timestamps();
        });

        Schema::create('admin_group_user', function (Blueprint $table) {
            $table->foreignId('admin_user_id')->constrained();
            $table->foreignId('admin_group_id')->constrained();
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
        Schema::dropIfExists('admin_group_user');
        Schema::dropIfExists('admin_groups');
    }
}
