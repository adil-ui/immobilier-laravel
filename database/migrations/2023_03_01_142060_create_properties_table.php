<?php

use App\Models\Category;
use App\Models\City;
use App\Models\District;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('picture', 255);
            $table->string('description');
            $table->integer('property_Num');
            $table->foreignIdFor(Category::class);
            $table->integer('type');
            $table->double('price');
            $table->integer('bedroom');
            $table->integer('bathroom');
            $table->integer('living_room');
            $table->integer('floor');
            $table->integer('area');
            $table->date('building_date');
            $table->integer('zip_code');
            $table->float('longitude');
            $table->float('latitude');
            $table->foreignIdFor(City::class);
            $table->foreignIdFor(Sector::class);
            $table->foreignIdFor(District::class);
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
