<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keywordables', function (Blueprint $table) {
            $table->foreignId('keyword_id')->constrained('keywords')->onDelete('cascade');
            $table->morphs('keywordable');

            $table->primary(['keyword_id', 'keywordable_id', 'keywordable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keywordables');
    }
};
