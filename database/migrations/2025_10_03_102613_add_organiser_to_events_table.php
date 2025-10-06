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
    Schema::table('rooms', function (Blueprint $table) {
        $table->string('organiser')->nullable()->after('total_room'); 
        // "after('event_name')" = place column after event_name (change if needed)
    });
}

public function down()
{
    Schema::table('rooms', function (Blueprint $table) {
        $table->dropColumn('organiser');
    });
}

};
