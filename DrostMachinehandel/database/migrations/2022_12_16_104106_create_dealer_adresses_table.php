<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealer_addresses', function (Blueprint $table) {
            $table->id();
            $table->string("country");
            $table->string("province");
            $table->string("city");
            $table->string("streetname");
            $table->string("housenumber");
            $table->string("postalcode");
            $table->string("dealer_id");
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
        Schema::dropIfExists('dealer_adresses');
    }
};
