<?php

function generateGUID() {
    if (function_exists('com_create_guid') === true) {
        return trim(com_create_guid(), '{}');
    }

    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}

$xmlFile = 'scpc-feed.xml';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input

    $title = htmlspecialchars($_POST['title']);
    $link = htmlspecialchars($_POST['link']);
    $description = htmlspecialchars($_POST['description']);
    $pubDate = htmlspecialchars($_POST['pubDate']);
    $category = htmlspecialchars($_POST['category']);
    $newCategory = htmlspecialchars($_POST['newCategory']);
    $author = htmlspecialchars($_POST['author']);
    $imageSrc = htmlspecialchars($_POST['imageSrc']);

    // Validate required fields
    if (empty($title) || empty($link) || empty($description) || empty($pubDate) || empty($category) || empty($author) || empty($imageSrc)) {
        die('Error: All fields are required.');
    }

    // Read the existing XML file
    $doc = new DOMDocument();
    $doc->preserveWhiteSpace = false;
    $doc->formatOutput = true;

    if (!file_exists($xmlFile)) {
        // Create a new XML file if it doesn't exist
        $rss = $doc->createElement('rss');
        $rss->setAttribute('xmlns:atom', 'http://www.w3.org/2005/Atom');
        $rss->setAttribute('xmlns:content', 'http://purl.org/rss/1.0/modules/content/');
        $rss->setAttribute('version', '2.0');
        $doc->appendChild($rss);

        $channel = $doc->createElement('channel');
        $rss->appendChild($channel);
    } else {
        $doc->load($xmlFile);
        $channel = $doc->getElementsByTagName('channel')->item(0);
    }

    // Create a new XML element for the new item
    $newItem = $doc->createElement('item');
    $channel->appendChild($newItem);

    $newItem->appendChild($doc->createElement('title', $title));
    $newItem->appendChild($doc->createElement('link', $link));
    $newItem->appendChild($doc->createElement('description', $description));
   

    $newItem->appendChild($doc->createElement('pubDate', $pubDate));
    $newItem->appendChild($doc->createElement('category', ($category === 'other' ? $newCategory : $category)));
    $newItem->appendChild($doc->createElement('author', $author));

    // Use CDATA for content:encoded to handle HTML content
    $contentEncoded = $doc->createElement('content:encoded');
    $contentEncoded->appendChild($doc->createCDATASection('<img src="' . $imageSrc . '" />'));
    $newItem->appendChild($contentEncoded);

    $newItem->appendChild($doc->createElement('guid', generateGUID()))->setAttribute('isPermaLink', 'false');

    // Save the modified XML back to the file
    $doc->save($xmlFile);
   
    echo 'Item added successfully';
    // Redirect to the dashboard
    header('Location: dashboard.php');
    exit;
} else {
    // If the form is not submitted via POST method
    die('Error: Form not submitted.');
}
?>
