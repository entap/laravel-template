<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPropertyGroupPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_property_group_property', function (
            Blueprint $table
        ) {
            $table->foreignId('property_id')->constrained('admin_properties');
            $table
                ->foreignId('property_group_id')
                ->constrained('admin_property_groups');
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
        Schema::dropIfExists('admin_property_group_property');
    }
}
