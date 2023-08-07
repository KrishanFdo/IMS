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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname',50);
            $table->string('lname',50);
            $table->string('eyear',4);
            $table->string('pyear',4);
            $table->string('mobile',14);
            $table->string('wmobile',14);
            $table->string('scnum',15)->unique();
            $table->string('email',50)->unique();
            $table->string('workplace',150);
            $table->string('role',15);
            $table->string('position',100);
            $table->string('qualifications',100);
            $table->string('country',30);
            $table->string('imgpath')->nullable();
            $table->string('password',60);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
