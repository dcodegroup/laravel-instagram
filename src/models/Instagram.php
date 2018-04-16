<?php

namespace DcodeGroup\InstagramFeed\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instagram extends Model
{
	use SoftDeletes;

	protected $table = 'instagrams';

	protected $guarded = 'id';

}
