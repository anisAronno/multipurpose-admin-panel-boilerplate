<?php

namespace Database\Seeders;

use AnisAronno\MediaGallery\Models\Media;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MediaSeeder extends Seeder
{
    protected $model = Media::class;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Media::truncate();
        Schema::enableForeignKeyConstraints();

        Media::factory()->count(50)->create();
    }
}
