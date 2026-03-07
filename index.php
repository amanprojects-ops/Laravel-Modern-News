<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 * This file redirects all requests to the public/index.php file
 */

// Set the public path
$publicPath = __DIR__ . '/public';

// Check if the request is for a static asset in the public directory
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$requested_file = $publicPath . $uri;

if ($uri !== '/' && file_exists($requested_file) && !is_dir($requested_file)) {
    // If the file exists in public directory, return it directly
    $pathInfo = pathinfo($requested_file);
    $extension = strtolower($pathInfo['extension'] ?? '');

    // Set the appropriate content type header
    switch ($extension) {
        case 'css':
            header('Content-Type: text/css');
            break;
        case 'js':
            header('Content-Type: application/javascript');
            break;
        case 'jpg':
        case 'jpeg':
            header('Content-Type: image/jpeg');
            break;
        case 'png':
            header('Content-Type: image/png');
            break;
        // Add more content types as needed
    }

    // Output the file and exit
    readfile($requested_file);
    exit;
}

// Otherwise, include the public/index.php file
require_once $publicPath . '/index.php';
?>
