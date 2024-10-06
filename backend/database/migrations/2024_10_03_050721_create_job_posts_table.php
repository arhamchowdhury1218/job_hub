<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id'); // Change user_id to account_id
            $table->string('type');
            $table->string('title');
            $table->text('description');
            $table->string('salary');
            $table->string('location');
            $table->string('company_name');
            $table->text('company_description')->nullable();
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
            $table->timestamps();

            // Foreign key constraint to the accounts table
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
