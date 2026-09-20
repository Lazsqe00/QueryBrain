<?php
namespace Support;
class MarkdownRenderer
{
    public static function render(string $text): string
    {
        $parsedown = new Parsedown();
        return $parsedown->text($text);
    }
}