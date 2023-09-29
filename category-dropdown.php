<?php
// Reusable method to generate category dropdown options
function generateCategoryDropdown($selectedCategory = '') {
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
    $output = '<select id="category" name="category" class="form-select" required>';
    $output .= '<option value="" disabled selected>Select Category or Add New</option>';
    foreach ($categories as $category) {
        $output .= '<option value="' . htmlspecialchars($category) . '"' . ($selectedCategory === $category ? ' selected' : '') . '>' . htmlspecialchars($category) . '</option>';
    }
    $output .= '<option value="other"' . ($selectedCategory === 'other' ? ' selected' : '') . '>Add New Category</option>';
    $output .= '</select>';

    return $output;
}
?>
