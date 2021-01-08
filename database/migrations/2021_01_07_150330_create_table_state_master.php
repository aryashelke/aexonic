<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\Log;

class CreateTableStateMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::create('mst_state', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('country_id');
                $table->enum('status', ['A', 'I'])->default('A');
            });
        }catch (Exception $e){
            Log::error("Exception occure while executing CreateTableStateMaster", [$e]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
