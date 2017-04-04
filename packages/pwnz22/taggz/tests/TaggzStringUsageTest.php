<?php

class TaggzStringUsageTest extends TestCase
{

    protected $lesson;

    public function setUp()
    {
        parent::setUp();

        $this->lesson = \LessonStub::create([
            'title' => 'A lesson title.'
        ]);
    }

    /** @test */
    public function it_can_tag_a_lesson()
    {

    }
}