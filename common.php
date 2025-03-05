<?php

//Escape function to sanitize data for security and prevent XSS attacks.
//@param string $data The input data to be sanitized.
// @return string The sanitized data.

function escape($data) {
    // htmlspecialchars() converts special characters to HTML entities to prevent XSS attacks
    // ENT_QUOTES ensures both double and single quotes are encoded
    // ENT_SUBSTITUTE replaces invalid character encoding with a replacement character
    // "UTF-8" is specified as the character encoding
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
    
    // trim() removes any leading or trailing whitespace from the input
    $data = trim($data);
    
    // stripslashes() removes any backslashes added by PHP (often used with magic quotes)
    $data = stripslashes($data);
    
    // Return the sanitized version of the data
    return $data;
}
?>
