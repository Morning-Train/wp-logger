<?php

namespace Morningtrain\WP\Logger\Models;

use Illuminate\Database\Eloquent\Model;

class DbLogger extends Model
{
    protected $table = 'db_logger';

    protected $guarded = [];

    public $timestamps = true;
}
