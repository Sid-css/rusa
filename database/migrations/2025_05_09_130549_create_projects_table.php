<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scheme_id')
                  ->constrained('schemes')
                  ->onDelete('cascade');
            $table->string('name');
            $table->decimal('approved_amount', 15, 2);
            $table->decimal('received_amount', 15, 2);
            $table->string('photo')->nullable();
            $table->string('phase', 100);
            $table->enum('status', ['ongoing', 'completed']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
