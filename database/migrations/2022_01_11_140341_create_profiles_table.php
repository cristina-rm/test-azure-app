<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // $table->string('prefix')->nullable();
            $table->string('first_name')->nullable();
            // $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            // $table->string('suffix')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('company_name')->nullable();
            /*$table->string('company_division')->nullable();
            $table->string('company_function')->nullable();*/
            // $table->string('email_secondary')->nullable();
            // $table->string('avatar')->nullable();
            $table->string('mobile_phone')->nullable();
            /*$table->string('work_phone')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('social_urls')->nullable();*/
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
