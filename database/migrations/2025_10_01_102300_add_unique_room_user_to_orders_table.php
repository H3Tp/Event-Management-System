<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        // if you use user_id:
        $table->unique(['room_id', 'user_id'], 'orders_room_user_unique');

        // if you allow guest email bookings and want uniqueness by email+room:
        // $table->unique(['room_id', 'email'], 'orders_room_email_unique');
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropUnique('orders_room_user_unique');
        // $table->dropUnique('orders_room_email_unique');
    });
}

};
