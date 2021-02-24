<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDynamicContentCategoryDynamicPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dynamic_content_category_dynamic_page', function (
            Blueprint $table
        ) {
            $table
                ->foreignId('dynamic_content_category_id')
                ->constrained()
                ->onDelete('cascade');
            $table
                ->foreignId('dynamic_page_id')
                ->constrained()
                ->onDelete('cascade');
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
        Schema::dropIfExists('dynamic_content_category_dynamic_page');
    }
}
