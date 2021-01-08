<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryMaster extends Model
{
	protected $table = "mst_country";

	const STATUS_ACTIVE = "A";
	const STATUS_INACTIVE = "I";

	public static function getTableName(){
        return with(new static)->getTable();
    }
}
