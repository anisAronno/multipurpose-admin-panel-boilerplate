<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('site_title')->nullable();
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->string('fav_icon')->nullable();
            $table->string('copyright_message')->nullable();
            $table->string('copyright_name')->nullable();
            $table->string('copyright_url')->nullable();
            $table->longText('design_develop_by')->nullable();
            $table->longText('design_develop_by_url')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
