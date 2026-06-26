<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keyword_keyword_group', function (Blueprint $table) {
            $table->foreignId('keyword_id')->constrained('keywords')->onDelete('cascade');
            $table->foreignId('keyword_group_id')->constrained('keyword_groups')->onDelete('cascade');
            $table->primary(['keyword_id', 'keyword_group_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keyword_keyword_group');
    }
};
