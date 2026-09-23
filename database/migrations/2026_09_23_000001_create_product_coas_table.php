<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_coas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('coa_image_path')->nullable();
            $table->string('coa_image_disk')->default('local')->nullable();
            $table->string('coa_pdf_path')->nullable();
            $table->string('coa_pdf_disk')->default('local')->nullable();
            $table->string('batch_number')->nullable();
            $table->date('test_date')->nullable();
            $table->timestamps();

            // FK to lunar_products (using prefix from config)
            $table->foreign('product_id')
                  ->references('id')
                  ->on('lunar_products')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_coas');
    }
};
