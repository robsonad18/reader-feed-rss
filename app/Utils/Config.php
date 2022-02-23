<?php 

namespace App\Utils;

class Config 
{
    /**
     * Url do fee RSS da TecMundo
     *
     * @var string
     */
    public string $feedUrl = "";

    public function __construct()
    {
        $this->feedUrl = "https://rss.tecmundo.com.br/feed";
    }

    public function getFeedUrl():?string
    {
        return $this->feedUrl;
    }
}