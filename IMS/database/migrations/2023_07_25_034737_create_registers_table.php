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
        Schema::create('registers', function (Blueprint $table) {
            $table->integer('r_id')->autoIncrement();
            $table->string('r_fname',15);
            $table->string('r_lname',50);
            $table->string('r_year',4);
            $table->string('r_mobile',10);
            $table->string('r_scnum',15)->unique();
            $table->string('r_email',50)->unique();
            $table->string('r_workplace',25);
            $table->string('r_role',5);
            $table->string('r_position',50);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};
