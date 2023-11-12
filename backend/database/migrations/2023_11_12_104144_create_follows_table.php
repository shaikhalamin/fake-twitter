<?php

use Illuminate\Database\Migrations\Migration;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->create('follows', function (Blueprint $table) {
            // $table->objectId('follower')->references('users');
            // $table->objectId('followee')->references('users');
            $table->objectId('follower')->index('follower');
            $table->objectId('followee')->index('followee');
            $table->reference('follower', 'User');
            $table->reference('followee', 'User');
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
        Schema::connection('mongodb')->dropIfExists('follows');
    }
}
