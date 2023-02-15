<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();

            $table->morphs(name: 'tokenable');
            $table->string(column: 'name');
            $table->string('token', 64)->unique();
            $table->text(column: 'abilities')->nullable();
            $table->timestamp(column: 'last_used_at')->nullable();
            $table->timestamp(column: 'expires_at')->nullable();

            $table->timestamps();
        });
    }
};
