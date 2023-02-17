<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->text('short_description')->nullable();  
            $table->longText('description')->nullable();  
            $table->string('status')->default('Draft');
            $table->string('type')->default('Digital');
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_commentable')->default(1);
            $table->tinyInteger('is_reactable')->default(1);
            $table->tinyInteger('is_shareable')->default(1);
            $table->tinyInteger('show_ratings')->default(1);
            $table->tinyInteger('show_views')->default(1);
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
        Schema::dropIfExists('products');
    }
};
