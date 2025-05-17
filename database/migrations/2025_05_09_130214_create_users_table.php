<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'institution_user']);
            $table->foreignId('institution_id')
                  ->nullable()
                  ->constrained('institutions')
                  ->onDelete('set null');
                  $table->timestamps(); // ✅ Add this line
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
