<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('title');
            $table->text('description');
            $table->string('salary');
            $table->string('location');
            $table->string('company_name');
            $table->text('company_description')->nullable();
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
            $table->foreignId('account_id')->constrained('accounts');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_posts');
    }
};