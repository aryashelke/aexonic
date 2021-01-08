<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StateMaster extends Model
{
    protected $table = "mst_state";

    const STATUS_ACTIVE = "A";
	const STATUS_INACTIVE = "I";
}
