<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('organizational_structures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->integer('order')->default(0);
            $table->foreignId('parent_id')->nullable()->constrained('organizational_structures')->onDelete('cascade');
            $table->timestamps();
        });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
