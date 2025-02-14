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
            $table->string('vendor_address');
            $table->string('contact_number');
            $table->longText('description')->nullable();
            $table->string('vendor_email')->unique();
            $table->enum('vendor_status', ['pending', 'approved', 'rejected'])->default('pending'); // Default is 'pending'
            $table->string('vendor_profile_img')->default('vendor_default.jpg');
            $table->foreignId(column: 'user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
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
