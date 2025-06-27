<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shelter_applications', function (Blueprint $table) {
            $table->id();
            $table->string('organization_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('address');
            $table->string('proof_document'); // maybe file path or name
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shelter_applications');
    }
};
