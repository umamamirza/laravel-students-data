<?php 

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

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->string('gender');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
        });


        // Schema::create('students', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name', 190);
        //     $table->integer('age');
        //     $table->string('gender', 190);
        //     $table->unsignedBigInteger('city_id')->nullable();
        //     $table->string('image')->nullable(); 
        //     $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

