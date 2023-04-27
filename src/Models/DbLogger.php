<?php

namespace Morningtrain\WP\Logger\Models;

use Illuminate\Database\Eloquent\Model;

class DbLogger extends Model
{
    protected $table = 'db_logger';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public $timestamps = true;
}
