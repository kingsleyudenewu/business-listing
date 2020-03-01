<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessListingImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_listing_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_listing_id')->unsigned();
            $table->foreign('business_listing_id')
                ->references('id')
                ->on('business_listings')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->softDeletes();
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
        Schema::dropIfExists('business_listing_images');
    }
}
