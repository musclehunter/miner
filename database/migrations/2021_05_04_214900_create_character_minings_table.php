<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterMiningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_minings', function (Blueprint $table) {
            $table->id();
            $table->integer('character_id')->comment('キャラクターID')->unique();
            $table->integer('state')->comment('行動の状態')->default(0);
            $table->integer('mine_id')->comment('鉱山ID');
            $table->dateTime('complete_at')->comment('完了時間')->default(null)->nullable();
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
        Schema::dropIfExists('character_minings');
    }
}
