<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid(column: 'uuid')->unique();
            $table->string(column: 'reg_id')->unique()->nullable();

            $table->string(column: 'name');
            $table->string(column: 'email')->unique();
            $table->string(column: 'password'); //

            $table->string(column: 'cob')->nullable();
            $table->string(column: 'race')->nullable();
            $table->string(column: 'address')->nullable();
            $table->string(column: 'class')->nullable();
            $table->integer(column: 'age')->nullable();
            $table->string(column: 'father_name')->nullable();
            $table->string(column: 'father_phone')->nullable();
            $table->string(column: 'mother_name')->nullable();
            $table->string(column: 'mother_phone')->nullable();

            $table->foreignId(column: 'role_id')
                ->index()
                ->constrained();

            $table->string(column: 'date_of_birth')->nullable();
            $table->string(column: 'enroll_date')->nullable();
            $table->timestamp('email_verified_at')->nullable();


            $table->rememberToken();
            $table->timestamps();
        });
    }
};
