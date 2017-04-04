<?php

namespace Pwnz22\Taggz\Models;

use Illuminate\Database\Eloquent\Model;
use Pwnz22\Taggz\Scopes\TagUsedScopesTrait;

class Tag extends Model
{
    use TagUsedScopesTrait;
}
