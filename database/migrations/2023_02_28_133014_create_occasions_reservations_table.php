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
        Schema::create('occasions_reservations', function (Blueprint $table) {
            $table->id();
            $table->string("dealer_id");
            $table->string("vehicle_name");
            $table->string("vehicle_image");
            $table->string("vehicle_price");
            $table->string("distance");
            $table->timestamp("status")->nullable();
            $table->string("auth_type");
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
        Schema::dropIfExists('occasions_reservations');
    }
};
