<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Created by PhpStorm.
 * User: ray
 * Date: 2017/3/26
 * Time: 18:28
 */
class MarkdownerTest extends TestCase
{
    protected $markdown;

    public function setup()
    {
        $this->markdown = new App\Services\Markdowner();
    }

    public function testSimpleParagraph()
    {
        $this->assertEquals('<p>test</p>\n', $this->markdown->toHtml('test'));
    }
}