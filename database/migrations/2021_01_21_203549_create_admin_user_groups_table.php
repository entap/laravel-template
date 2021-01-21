<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_user_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->nestedSet();
            $table->timestamps();
        });

        Schema::create('admin_user_group_user', function (Blueprint $table) {
            $table->foreignId('group_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();

            $table->index(['group_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_user_groups');
    }
}
