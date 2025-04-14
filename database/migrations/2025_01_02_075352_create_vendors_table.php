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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_name');
            $table->string('vendor_email')->unique();
            $table->string('city');
            $table->string('vendor_address');
            $table->string('phone_number');
            $table->longText('bio')->nullable();
            $table->integer('pan_number');
            $table->string('vendor_profile_img')->default('vendor_default.jpg');
            $table->string('document')->nullable();
            $table->enum('vendor_status', ['pending', 'rejected', 'active', 'blocked'])->default('pending');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
