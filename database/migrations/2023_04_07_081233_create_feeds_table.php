<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Advertiser;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Advertiser::class)->nullable();
            $table->string("feedId")->unique();
            $table->string("feedPath")->nullable();
            $table->string("keywordParameter")->nullable();
            $table->integer("priorityScore")->nullable();
            $table->string("staticParameters")->nullable();
            $table->string("dynamicParameters")->nullable();
            $table->string("comments")->nullable();
            $table->enum('status', ['live', 'pause', 'enable', 'disable'])->default('enable');
            $table->boolean('is_default')->default(0);
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
        Schema::dropIfExists('feeds');
    }
};
