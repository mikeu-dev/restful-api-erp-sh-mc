<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Kategori produk
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Warehouse / gudang
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('location')->nullable();
            $table->timestamps();
        });

        // Tabel produk
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('sku')->nullable()->unique();
            $table->foreignId('category_id')->nullable()->constrained('product_categories')->nullOnDelete();
            $table->decimal('price', 15, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // Stok per produk
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('warehouse_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('quantity')->default(0);
            $table->timestamps();
        });

        // Asset internal
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('type'); // hardware, software
            $table->string('serial_number')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('value', 15, 2)->nullable();
            $table->string('status')->default('active'); // active, maintenance, retired
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('assets');
        Schema::dropIfExists('warehouses');
        Schema::dropIfExists('product_stocks');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_categories');
    }
};
