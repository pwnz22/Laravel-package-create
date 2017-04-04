<?php

use Illuminate\Database\Eloquent\Model;
use Pwnz22\Taggz\TaggableTrait;

class LessonStub extends Model
{
    use TaggableTrait;

    protected $connection = 'testbench';

    public $table = 'lessons';
}