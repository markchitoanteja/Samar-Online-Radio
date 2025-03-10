<?php

/**
 * Retrieves and sanitizes a specific POST data field.
 *
 * This function checks if the specified POST data field exists, sanitizes it by removing
 * HTML and PHP tags, and converts special characters to HTML entities to prevent XSS attacks.
 *
 * @param string $key The key of the POST data to retrieve and sanitize.
 * @return string|false Returns the sanitized POST data as a string,
 *                      or false if the key does not exist or is empty.
 */
function post($key)
{
    if (isset($_POST[$key]) && !empty($_POST[$key])) {
        return htmlspecialchars(strip_tags($_POST[$key]), ENT_QUOTES, 'UTF-8');
    } else {
        return false;
    }
}