<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodoTable extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('todo');

        Schema::create('todo', static function (Blueprint $table) {
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('description');
            $table->dateTime('datetime');
            $table->string('status');
            $table->string('category');
            $table->uuid('user_uuid');
            $table->timestamps();
            $table->foreign('user_uuid')->references('uuid')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('todo');
    }
}
