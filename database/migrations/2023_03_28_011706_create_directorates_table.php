<?php

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
        Schema::create('directorates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['public', 'private', 'religious']);
            $table->string('educational_district');
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('educational_director_name')->nullable();
            $table->string('educational_director_phone_number')->nullable();
            $table->unsignedInteger('students_number')->nullable();
            $table->unsignedInteger('teachers_number')->nullable();
            $table->text('departments')->nullable();
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
        Schema::dropIfExists('directorates');
    }
};
