<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_models', function (Blueprint $table) {
            $table->bigInteger('organization_id');
            $table->bigInteger('model_id');
            $table->string('model_type');
            $table->boolean('pending')->default(false);
            $table->boolean('owner')->default(false);
            $table->string('invite_key')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_models');
    }
}
