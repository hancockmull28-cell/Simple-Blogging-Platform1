<?php
/**
 * Health Check Endpoint
 * Provides a lightweight endpoint for keep-alive pings
 */

header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate');

// Simple health check response
$response = [
    'status' => 'healthy',
    'timestamp' => date('c'),
    'uptime' => time(),
    'service' => 'Simple Blog Platform',
    'version' => '2.0.0'
];

// Optional: Check database connection
try {
    require_once 'include/db.php';
    $pdo = getConnection();
    
    if ($pdo !== null || $GLOBALS['useJsonFallback']) {
        $response['database'] = 'connected';
    } else {
        $response['database'] = 'fallback_mode';
    }
} catch (Exception $e) {
    $response['database'] = 'error';
}

// Return JSON response
echo json_encode($response, JSON_PRETTY_PRINT);
?>