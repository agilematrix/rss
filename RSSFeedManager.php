<?php

class RSSFeedManager {
    // Array to store feed items
    private $feedItems = [];

    // Add a new feed item
    public function addItem($item) {
        $this->feedItems[] = $item;
    }

    // Get all feed items
    public function getFeedItems() {
        return $this->feedItems;
    }

    // Update a specific feed item
    public function updateItem($index, $updatedItem) {
        if (isset($this->feedItems[$index])) {
            $this->feedItems[$index] = $updatedItem;
        } else {
            throw new Exception("Invalid index for updating feed item.");
        }
    }

    // Delete a specific feed item
    public function deleteItem($index) {
        if (isset($this->feedItems[$index])) {
            array_splice($this->feedItems, $index, 1);
        } else {
            throw new Exception("Invalid index for deleting feed item.");
        }
    }

    // Save the feed to a file based on the category
    public function saveFeed($category) {
        // Logic to save the feed to a file (category-specific)
        // Example: file_put_contents("scpc-{$category}-feed.xml", $xmlContent);
    }
}

?>
