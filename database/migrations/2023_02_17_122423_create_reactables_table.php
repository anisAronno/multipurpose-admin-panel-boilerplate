<?php

use App\Models\React;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reactables', function (Blueprint $table) {
            $table->foreignIdFor(React::class)->constrained();
            $table->unsignedBigInteger('reactable_id');
            $table->string('reactable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reactables');
    }
};
