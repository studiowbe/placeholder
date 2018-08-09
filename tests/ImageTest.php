<?php

namespace Studiow\Placeholder\Test;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Studiow\Placeholder\Image;

class ImageTest extends TestCase
{
    /**
     * @test
     */
    public function settingSize()
    {
        $img = new Image(300, 250);

        //from constructor
        $this->assertStringEndsWith('/300x250', (string) $img);

        $this->assertStringEndsWith('/300x300', (string) $img->height(300));
        $this->assertStringEndsWith('/200x300', (string) $img->width(200)->height(300));
    }

    /**
     * @test
     */
    public function usingImageFormats()
    {
        $img = new Image(300);
        $this->assertStringEndsWith('.jpg', (string) $img->format('jpg'));
        $this->assertStringEndsWith('.jpeg', (string) $img->format('jpeg'));
        $this->assertStringEndsWith('.gif', (string) $img->format('gif'));
        $this->assertStringEndsWith('.png', (string) $img->format('png'));
    }

    /**
     * @test
     */
    public function usingInvalidImageFormatThrowsException()
    {
        $img = new Image(300);
        $this->expectException(InvalidArgumentException::class);
        $img->format('svg');
    }

    /**
     * @test
     */
    public function addingText()
    {
        $img = new Image(300);
        $this->assertStringEndsWith('?text=A+test+text', (string) $img->text('A test text'));
    }

    /**
     * @test
     */
    public function settingBackgroundColor()
    {
        $img = new Image(300);
        $this->assertStringEndsWith('06C', (string) $img->background('06C'));
        $this->assertStringEndsWith('0066CC', (string) $img->background('0066CC'));
    }

    /**
     * @test
     */
    public function usingInvalidBackgroundColorThrowsException()
    {
        $img = new Image(300);
        $this->expectException(InvalidArgumentException::class);
        $img->background('red');
    }

    /**
     * @test
     */
    public function settingTextColor()
    {
        $img = new Image(300);
        $this->assertStringEndsWith('/06C', (string) $img->color('06C'));
        $this->assertStringEndsWith('/0066CC', (string) $img->color('0066CC'));
    }

    /**
     * @test
     */
    public function usingInvalidTextColorThrowsException()
    {
        $img = new Image(300);
        $this->expectException(InvalidArgumentException::class);
        $img->color('red');
    }

    /**
     * @test
     */
    public function settingTextColorMustSetBackgroundColor()
    {
        $img = new Image(300);
        $this->assertStringEndsWith('/ccc/06C', (string) $img->color('06C'));
    }
}
