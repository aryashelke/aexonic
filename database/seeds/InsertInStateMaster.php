<?php

use Illuminate\Database\Seeder;

use App\StateMaster;

class InsertInStateMaster extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $state_list = StateMaster::get();

        /**
         * If country_master table having records delete all records
         */
        if ($state_list->isNotEmpty()) {
        	DB::table(StateMaster::getTableName())->truncate();
        }

        StateMaster::insert(trans('state'));
    }
}
