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
        Schema::create('guest_user_addresses', function (Blueprint $table) {
            $table->id();
            $table->string("country");
            $table->string("city");
            $table->string("streetname");
            $table->string("housenumber");
            $table->string("postalcode");
            $table->string("guest_user_id");
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
        Schema::dropIfExists('guest_user_addresses');
    }
};
