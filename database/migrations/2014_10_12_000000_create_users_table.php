<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\Log;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('contact', 10);
                $table->string('email')->unique();
                $table->string('profile_image');
                $table->integer('country_id');
                $table->integer('state_id');
                $table->string('city');
                $table->string('pincode', 6);
                $table->enum('status', ['A', 'I'])->default('A');
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });

        } catch (Exception $e){
            Log::error("Exception occure while executing CreateUsersTable", [$e]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
