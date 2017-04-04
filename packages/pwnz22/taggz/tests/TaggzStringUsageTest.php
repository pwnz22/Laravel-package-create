<?php

class TaggzStringUsageTest extends TestCase
{

    protected $lesson;

    public function setUp()
    {
        parent::setUp();

        foreach(['PHP', 'Laravel', 'Testing', 'Redis', 'Postgres', 'Fun Stuff'] as $tag) {
            \TagStub::create([
                'name' => $tag,
                'slug' => str_slug($tag),
                'count' => 0
            ]);
        }

        $this->lesson = \LessonStub::create([
            'title' => 'A lesson title.'
        ]);
    }

    /** @test */
    public function it_can_tag_a_lesson()
    {
        $this->lesson->tag(['laravel', 'php']);

        $this->assertCount(2, $this->lesson->tags);

        foreach (['Laravel', 'PHP'] as $tag) {
            $this->assertContains($tag, $this->lesson->tags->pluck('name'));
        }
    }
}