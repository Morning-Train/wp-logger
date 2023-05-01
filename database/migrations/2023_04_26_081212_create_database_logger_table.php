<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('database_logger', function (Blueprint $table) {
            $table->id();
            $table->string('error_level');
            $table->text('error_message');
            $table->text('error_context');
            $table->text('error_backtrace');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('database_logger');
    }
};