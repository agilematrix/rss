<?php
// Reusable method to generate category filter select options
function generateCategoryFilter($selectedCategory = '') {
    // Read the existing XML file
    $xmlFile = 'scpc-feed.xml';
    $xml = simplexml_load_file($xmlFile);

    // Extract categories from the XML
    $categories = [];
    foreach ($xml->channel->item as $item) {
        $categories[] = (string)$item->category;
    }

    // Remove duplicates
    $categories = array_unique($categories);

    // Output the select options
    $output = '<select id="categoryFilter" class="form-select mb-3" onchange="filterByCategory()">';
    $output .= '<option value=""' . ($selectedCategory === '' ? ' selected' : '') . '>All</option>';
    foreach ($categories as $category) {
        $output .= '<option value="' . htmlspecialchars($category) . '"' . ($selectedCategory === $category ? ' selected' : '') . '>' . htmlspecialchars($category) . '</option>';
    }
    $output .= '</select>';

    return $output;
}
?>
