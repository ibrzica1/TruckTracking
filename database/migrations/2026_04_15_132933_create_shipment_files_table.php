<?php

use App\Models\Shipment;
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
        Schema::create('shipment_files', function (Blueprint $table) {
            $table->id();
            $table->string('file_name',128);
            $table->foreignIdFor(Shipment::class)
            ->constrained()
            ->cascadeOnDelete();
            $table->string('type',10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipment_files');
    }
};
