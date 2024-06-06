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
        Schema::create('sales_details', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->integer("sales_id");
            $table->integer("menu_id");
            $table->string("menu_name");
            $table->integer("menu_price");
            $table->integer("quantity");
            $table->string("status")->default("noConfirm");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_details');
    }
};
