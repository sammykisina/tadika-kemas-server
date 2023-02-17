<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->uuid(column: 'uuid')->unique();

            $table->string(column: "type");
            $table->string(column: 'period');
            $table->integer(column: 'year');
            $table->string(column: 'subject');
            $table->integer(column: 'marks');
            $table->integer(column: "totalAwarding");

            $table->string(column: 'status');
            $table->text(column: 'comment');

            $table->unsignedBigInteger(column: 'studentId');
            $table->foreign(columns:'studentId')
                ->references(columns: 'id')
                ->on(table: "users")
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }
};
