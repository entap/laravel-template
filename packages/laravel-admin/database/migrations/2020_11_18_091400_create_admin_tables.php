<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTables extends Migration
{
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('admin_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('admin_user_role', function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->foreignId('role_id');
            $table->timestamps();

            $table->index(['user_id', 'role_id']);
        });

        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('admin_user_permission', function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->foreignId('permission_id');
            $table->timestamps();

            $table->index(['user_id', 'permission_id']);
        });

        Schema::create('admin_role_permission', function (Blueprint $table) {
            $table->foreignId('role_id');
            $table->foreignId('permission_id');
            $table->timestamps();

            $table->index(['role_id', 'permission_id']);
        });

        Schema::create('admin_operations', function (Blueprint $table) {
            $table->id();
            $table->string('method');
            $table->string('action');
            $table->timestamps();
        });

        Schema::create('admin_permission_operation', function (
            Blueprint $table
        ) {
            $table->foreignId('permission_id');
            $table->foreignId('operation_id');
            $table->timestamps();

            $table->index(['permission_id', 'operation_id']);
        });

        Schema::create('admin_menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('uri')->nullable();
            $table->nestedSet();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_permission_operation');
        Schema::dropIfExists('admin_role_permission');
        Schema::dropIfExists('admin_user_permission');
        Schema::dropIfExists('admin_user_role');
        Schema::dropIfExists('admin_operations');
        Schema::dropIfExists('admin_permissions');
        Schema::dropIfExists('admin_roles');
        Schema::dropIfExists('admin_users');

        Schema::dropIfExists('admin_menu_items');
    }
}
