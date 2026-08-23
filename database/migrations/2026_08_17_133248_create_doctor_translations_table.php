<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctor_translations', function (Blueprint $table) {

            $table->id();

            // $table->unsignedBigInteger("doctor_id");//replace by foreignId('doctor_id')
            //references('id')->on('sections') ==> constrained('doctors') 
            $table->foreignId('doctor_id')->constrained('doctors') ->onDelete('cascade');

            $table->string('locale')->index();

            $table->string('name');

           $table->string('appointments');

            $table->unique(['doctor_id', 'locale']);


        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor_translations');
    }
};
