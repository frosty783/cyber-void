<?php

class MarkdownParser {
    
    public static function parse($text) {
        // Convert headers
        $text = preg_replace('/^# (.*)$/m', '<h1>$1</h1>', $text);
        $text = preg_replace('/^## (.*)$/m', '<h2>$1</h2>', $text);
        $text = preg_replace('/^### (.*)$/m', '<h3>$1</h3>', $text);
        
        // Convert bold and italic
        $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);
        $text = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $text);
        
        // Convert lists
        $text = preg_replace('/^- (.*)$/m', '<li>$1</li>', $text);
        $text = preg_replace('/(<li>.*<\/li>)/s', '<ul>$1</ul>', $text);
        
        // Convert code blocks
        $text = preg_replace('/```(.*?)```/s', '<pre><code>$1</code></pre>', $text);
        $text = preg_replace('/`(.*?)`/', '<code>$1</code>', $text);
        
        // Convert paragraphs
        $text = preg_replace('/\n\n/', '</p><p>', $text);
        $text = '<p>' . $text . '</p>';
        
        // Convert line breaks
        $text = str_replace("\n", '<br>', $text);
        
        return $text;
    }
    
    public static function parseInline($text) {
        // Simple inline parsing for titles/descriptions
        $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);
        $text = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $text);
        $text = preg_replace('/`(.*?)`/', '<code>$1</code>', $text);
        
        return $text;
    }
}