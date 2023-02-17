<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->uuid(column: 'uuid')->unique();

            $table->string(column: 'name');
            $table->text(column: 'purpose');
            $table->string(column: 'date');
            $table->string(column: 'time');

            $table->timestamps();
        });
    }
};
