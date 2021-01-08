<?php

use Illuminate\Database\Seeder;

use App\CountryMaster as CountryMasterModel;

class CountryMaster extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country_list = CountryMasterModel::get();

        /**
         * If country_master table having records delete all records
         */
        if ($country_list->isNotEmpty()) {
        	DB::table(CountryMasterModel::getTableName())->truncate();
        }

        CountryMasterModel::insert(trans('country'));
    }
}
