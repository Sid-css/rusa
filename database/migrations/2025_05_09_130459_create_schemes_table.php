<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchemesTable extends Migration
{
    public function up()
    {
        Schema::create('schemes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')
                  ->constrained('institutions')
                  ->onDelete('cascade');
            $table->foreignId('scheme_details_id')
                  ->constrained('scheme_details')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('schemes');
    }
}
