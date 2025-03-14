<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $table = 'links';

    protected $guarded = [];

    static $statuses = [
        1 => '✅',
        0 => '❌',
    ];

    static $types = [
        1 => "Rating",
        2 => "Attend"
    ];
}
