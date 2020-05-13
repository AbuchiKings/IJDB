<?php

namespace Ninja;

class Markdown
{
    private $string;
    public function __construct($markdown)
    {
        $this->string = $markdown;
    }

    public function toHtml()
    {
        $text = htmlspecialchars($this->string, ENT_QUOTES, 'UTF-8');

        // strong
        $text = preg_replace('/__(.+?)__/s', '<strong>$1</strong>', $text);
        $text = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text);

        //emphasis
        $text = preg_replace('/_([^_]+)_/', '<em>$1</em>', $text);
        $text = preg_replace('/\*([^\*]+)\*/', '<em>$1</em>', $text);

        // Convert Windows (\r\n) to Unix (\n)
        $text = str_replace("\r\n", "\n", $text);
        // Convert Macintosh (\r) to Unix (\n)
        $text = str_replace("\r", "\n", $text);

        // Paragraphs
        $text = '<p>' . str_replace(
            "\n\n",
            '</p><p>',
            $text
        ) . '</p>';
        // Line breaks
        $text = str_replace("\n", '<br>', $text);

        // hyperlinks [linked text](link URL)
        $text = preg_replace(
            '/\[([^\]]+)]\(([-a-z0-9._~:\/?#@!$&\'()*+,;=%]+)\)/i',
            '<a href="$2">$1</a>',
            $text
        );
        return $text;
    }
}
