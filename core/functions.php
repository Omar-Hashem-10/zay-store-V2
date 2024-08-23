<?php


// Return a URL path
function url($path)
{
  return BASE_URL . "index.php?page=" . $path;
}

// Check if the request method matches the expected method (e.g., POST or GET)
function check_request_method($method)
{
  return $_SERVER["REQUEST_METHOD"] === $method;
}

// Check if a specific POST input is set
function check_post_input($input)
{
  return isset($_POST[$input]);
}

// Sanitize input by trimming and escaping special characters
function sanitize_input($input)
{
  return trim(htmlspecialchars(htmlentities($input)));
}

// Redirect to a specific path
function redirect($path)
{
  header("Location: $path");
  exit; // Ensure the script stops executing after redirect
}
