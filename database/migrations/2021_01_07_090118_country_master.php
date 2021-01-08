<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\Log;

class CountryMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            
            Schema::create('mst_country', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->enum('status', ['A', 'I'])->default('A');
                $table->timestamps();
            });

        }catch(Exception $e){
            Log::error("Exception occure while executing CreatePasswordResetsTable", [$e]);
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
