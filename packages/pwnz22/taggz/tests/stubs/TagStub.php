<?php

use Illuminate\Database\Eloquent\Model;
use Pwnz22\Taggz\Scopes\TaggableScopesTrait;

class TagStub extends Model
{
    use TaggableScopesTrait;

    protected $connection = 'testbench';

    public $table = 'tags';
}