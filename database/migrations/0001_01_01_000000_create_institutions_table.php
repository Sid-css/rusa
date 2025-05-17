<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionsTable extends Migration
{
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
        });
    }

    public function down()
    {
        Schema::dropIfExists('institutions');
    }
}
