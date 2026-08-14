<?php
/**
 * Cache Initialization for Performance
 * Sets up aggressive caching headers for static assets
 */

// Enable output buffering with compression
if (!ob_get_level()) {
    ob_start('ob_gzhandler');
}

// Set cache headers for static assets
function setCacheHeaders($contentType, $maxAge = 31536000) {
    header("Content-Type: $contentType");
    header("Cache-Control: public, max-age=$maxAge, immutable");
    header("Expires: " . gmdate('D, d M Y H:i:s', time() + $maxAge) . ' GMT');
    header("X-Content-Type-Options: nosniff");
}

// Handle static asset requests with proper caching
$requestUri = $_SERVER['REQUEST_URI'];
$filePath = parse_url($requestUri, PHP_URL_PATH);

// CSS files
if (preg_match('/\.css$/i', $filePath)) {
    setCacheHeaders('text/css; charset=UTF-8');
}

// JavaScript files
if (preg_match('/\.(js|mjs)$/i', $filePath)) {
    setCacheHeaders('application/javascript; charset=UTF-8');
}

// Image files
if (preg_match('/\.(jpg|jpeg|png|gif|webp|svg)$/i', $filePath)) {
    if (preg_match('/\.svg$/i', $filePath)) {
        setCacheHeaders('image/svg+xml; charset=UTF-8');
    } elseif (preg_match('/\.webp$/i', $filePath)) {
        setCacheHeaders('image/webp');
    } elseif (preg_match('/\.(jpg|jpeg)$/i', $filePath)) {
        setCacheHeaders('image/jpeg');
    } elseif (preg_match('/\.png$/i', $filePath)) {
        setCacheHeaders('image/png');
    } elseif (preg_match('/\.gif$/i', $filePath)) {
        setCacheHeaders('image/gif');
    }
}

// Font files (1 year cache)
if (preg_match('/\.(woff|woff2|ttf|eot)$/i', $filePath)) {
    if (preg_match('/\.woff2$/i', $filePath)) {
        setCacheHeaders('font/woff2');
    } elseif (preg_match('/\.woff$/i', $filePath)) {
        setCacheHeaders('font/woff');
    }
}
?>