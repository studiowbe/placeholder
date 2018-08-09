<?php

namespace Studiow\Placeholder;

use InvalidArgumentException;

class Image
{
    private $width;
    private $height;
    private $format;
    private $text;
    private $background;
    private $color;

    public function __construct(
        int $width,
        int $height = null
    ) {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Set the width of the image.
     *
     * @param int $width
     *
     * @return Image
     */
    public function width(int $width): Image
    {
        $clone = clone $this;
        $clone->width = $width;

        return $clone;
    }

    /**
     * Set the height of the image. When height is null, a square will be returned (height = width).
     *
     * @param int|null $height
     *
     * @return Image
     */
    public function height(int $height = null): Image
    {
        $clone = clone $this;
        $clone->height = $height;

        return $clone;
    }

    /**
     * Set the file format. Must be one of 'gif', 'jpg', 'jpeg', 'png', or null for default ('png').
     *
     * @param string|null $format
     *
     * @return Image
     */
    public function format(string $format = null): Image
    {
        if (! in_array($format, ['gif', 'jpg', 'jpeg', 'png'])) {
            throw new InvalidArgumentException("Invalid format {$format}");
        }

        $clone = clone $this;
        $clone->format = $format;

        return $clone;
    }

    /**
     * Set the text.
     *
     * @param string|null $text
     *
     * @return Image
     */
    public function text(string $text = null): Image
    {
        $clone = clone $this;
        $clone->text = $text;

        return $clone;
    }

    /**
     * Set the background color.
     *
     * @param string|null $backgroundColor
     *
     * @return Image
     */
    public function background(string $backgroundColor = null): Image
    {
        if (! is_null($backgroundColor)) {
            if (! $this->isValidHexColorString($backgroundColor)) {
                throw new InvalidArgumentException("Invalid color {$backgroundColor}");
            }
        }

        $clone = clone $this;
        $clone->backgroundColor = $backgroundColor;

        return $clone;
    }

    /**
     * Set the text color.
     *
     * @param string|null $color
     *
     * @return Image
     */
    public function color(string $color = null): Image
    {
        if (! is_null($color)) {
            if (! $this->isValidHexColorString($color)) {
                throw new InvalidArgumentException("Invalid color {$color}");
            }
        }

        $clone = clone $this;
        $clone->color = $color;

        return $clone;
    }

    private function isValidHexColorString(string $color): bool
    {
        return (bool) preg_match('/([a-f0-9]{3}){1,2}\b/i', $color);
    }

    public function __toString()
    {
        $parts = [
            'size' => $this->width.'x'.($this->height ?? $this->width),
            'background' => $this->backgroundColor,
            'color' => $this->color,
        ];

        // we must have a background color if we want to set a text color
        if (! is_null($this->color) && is_null($this->backgroundColor)) {
            $parts['background'] = 'ccc';
        }

        $url = 'https://via.placeholder.com/'.implode('/', array_filter($parts));
        if (! is_null($this->format)) {
            $url .= '.'.$this->format;
        }
        if (! is_null($this->text)) {
            $url .= '?'.http_build_query(['text' => $this->text]);
        }

        return $url;
    }
}
