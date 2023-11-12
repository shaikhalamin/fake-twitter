<?php

use Illuminate\Database\Migrations\Migration;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->create('likes', function (Blueprint $table) {
            $table->objectId('tweetId')->index('tweetId');
            $table->objectId('userId')->index('userId');
            $table->reference('tweetId', 'Tweet');
            $table->reference('userId', 'User');
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
        Schema::connection('mongodb')->dropIfExists('likes');
    }
}
