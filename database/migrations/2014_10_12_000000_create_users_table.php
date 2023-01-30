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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('username')->unique();
            $table->string('email')->unique()->index();
            $table->string('password');
            $table->string('token')->unique();
            $table->string('avatar')->nullable();
            $table->string('gender', 50)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('ip', 50)->nullable();
            $table->string('time_zone', 50)->default('Asia/Dhaka');
            $table->string('language', 50)->default('bn');
            $table->string('status')->default('Pending');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
