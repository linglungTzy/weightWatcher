<?php
function sanitize_input($input) {
    $input = trim($input);    
    $input = stripslashes($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');    return $input;
}
?>


