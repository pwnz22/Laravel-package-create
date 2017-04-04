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

    /** @test */
    public function it_can_untag_a_lesson()
    {
        $this->lesson->tag(['laravel', 'php', 'testing']);
        $this->lesson->untag(['laravel']);

        $this->assertCount(2, $this->lesson->tags);

        foreach (['PHP', 'Testing'] as $tag) {
            $this->assertContains($tag, $this->lesson->tags->pluck('name'));
        }
    }

    /** @test */
    public function can_untag_all_lesson_tags()
    {
        $this->lesson->tag(['laravel', 'php', 'testing']);
        $this->lesson->untag();

        $this->lesson->load('tags');
        $this->assertCount(0, $this->lesson->tags);
        $this->assertEquals(0, $this->lesson->tags->count());
    }

    /** @test */
    public function can_retag_lesson_tags()
    {
        $this->lesson->tag(['laravel', 'php', 'testing']);
        $this->lesson->retag(['laravel', 'postgres', 'redis']);

        $this->lesson->load('tags');

        $this->assertCount(3, $this->lesson->tags);

        foreach (['Laravel', 'Postgres', 'Redis'] as $tag) {
            $this->assertContains($tag, $this->lesson->tags->pluck('name'));
        }
    }

    /** @test */
    public function non_existing_tags_are_ignored_on_tagging()
    {
        $this->lesson->tag(['laravel', 'c++', 'sqs']);
        $this->assertCount(1, $this->lesson->tags->pluck('name'));

        foreach (['Laravel'] as $tag) {
            $this->assertContains($tag, $this->lesson->tags->pluck('name'));
        }
    }

    /** @test */
    public function inconsisten_tag_cases_are_normalized()
    {
        $this->lesson->tag(['Laravel', 'RedIS', 'TEStinG', 'Fun StuFF']);

        $this->assertCount(4, $this->lesson->tags);

        foreach (['Laravel', 'Redis', 'Testing', 'Fun Stuff'] as $tag) {
            $this->assertContains($tag, $this->lesson->tags->pluck('name'));
        }
    }
}