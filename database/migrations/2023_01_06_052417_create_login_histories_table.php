<?php

use App\Models\User;
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
        Schema::create('login_histories', function (Blueprint $table) {
            $table->id();
            $table->string('ip', 255)->nullable();
            $table->string('auth_source', 255)->default('own');
            $table->string('device_name', 255)->nullable()->index();
            $table->string('os_name', 255)->nullable()->index();
            $table->string('browser_name', 255)->nullable();
            $table->string('country_name', 255)->nullable()->index();
            $table->string('country_code', 255)->nullable();
            $table->string('region_code', 255)->nullable();
            $table->string('region_name', 255)->nullable();
            $table->string('city_name', 255)->nullable()->index();
            $table->string('zip_code', 255)->nullable();
            $table->string('latitude', 255)->nullable()->index();
            $table->string('longitude', 255)->nullable()->index();
            $table->string('time_zone', 255)->nullable();
            $table->string('area_code', 255)->nullable();
            $table->string('metro_code', 255)->nullable();
            $table->string('iso_code', 255)->nullable();
            $table->string('postal_code', 255)->nullable();
            $table->foreignIdFor(User::class)->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_histories');
    }
};
