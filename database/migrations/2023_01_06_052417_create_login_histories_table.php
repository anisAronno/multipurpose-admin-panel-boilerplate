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
            $table->string('ip', 100)->nullable()->index();
            $table->string('auth_source', 100)->default('own');
            $table->string('device_name', 100)->nullable()->index();
            $table->string('os_name', 100)->nullable()->index();
            $table->string('browser_name', 100)->nullable();
            $table->string('country_name', 100)->nullable()->index();
            $table->string('country_code', 100)->nullable();
            $table->string('region_code', 100)->nullable();
            $table->string('region_name', 100)->nullable();
            $table->string('city_name', 100)->nullable()->index();
            $table->string('zip_code', 100)->nullable();
            $table->string('latitude', 100)->nullable()->index();
            $table->string('longitude', 100)->nullable()->index();
            $table->string('time_zone', 100)->nullable();
            $table->string('area_code', 100)->nullable();
            $table->string('metro_code', 100)->nullable();
            $table->string('iso_code', 100)->nullable();
            $table->string('postal_code', 100)->nullable();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
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
