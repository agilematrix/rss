<?php

// RSSFeedItem.php

class RSSFeedItem {
    public $title;
    public $link;
    public $description;
    public $pubDate;
    public $category;
    public $author;
    public $contentEncoded;
    public $guid;

    public function __construct($title, $link, $description, $pubDate, $category, $author, $imgSrc) {
        $this->title = $title;
        $this->link = $link;
        $this->description = $description;
        $this->pubDate = $pubDate;
        $this->category = $category;
        $this->author = $author;

        // Generate a unique identifier for guid
        $this->guid = $this->generateUniqueGuid();

        // Incorporate imgSrc in contentEncoded with CDATA
        $this->contentEncoded = '<![CDATA[<img src="' . $imgSrc . '" />]]>';
    }

    // Function to generate a unique guid
    private function generateUniqueGuid() {
        // Using a combination of prefix and timestamp for uniqueness
        $prefix = 'AUTO_GUID_';
        $timestamp = microtime(true) * 10000; // Multiply by a large number to get more precision
        return $prefix . $timestamp;
    }
}





class RSSFeed
{
    public $title;
    public $link;
    public $description;
    public $items = [];

    public function __construct($title, $link, $description)
    {
        $this->title = $title;
        $this->link = $link;
        $this->description = $description;
    }

    public function addItem(RSSFeedItem $item)
    {
        $this->items[] = $item;
    }
}

function parseRSSFeed($xmlString)
{
    $xml = simplexml_load_string($xmlString);

    $rssFeed = new RSSFeed(
        (string)$xml->channel->title,
        (string)$xml->channel->link,
        (string)$xml->channel->description
    );

    foreach ($xml->channel->item as $item) {
        $title = (string)$item->title;
        $link = (string)$item->link;
        $description = (string)$item->description;
        $pubDate = (string)$item->pubDate;
        $category = (string)$item->category;
        $author = (string)$item->author;

        // Extract img src from content:encoded
        $contentEncoded = (string)$item->children('content', true)->encoded;
        preg_match('/<img src="([^"]+)"/', $contentEncoded, $matches);
        $imgSrc = isset($matches[1]) ? $matches[1] : '';

        $rssFeedItem = new RSSFeedItem($title, $link, $description, $pubDate, $category, $author, $imgSrc);
        $rssFeed->addItem($rssFeedItem);
    }

    return $rssFeed;
}


?>

















