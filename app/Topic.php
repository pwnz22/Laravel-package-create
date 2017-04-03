<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Pwnz22\Taggz\TaggableTrait;

class Topic extends Model
{
    use TaggableTrait;
}
