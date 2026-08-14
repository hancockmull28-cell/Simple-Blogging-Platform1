/**
 * Keep-Alive Script for Render Free Tier
 * This script pings your website every 14 minutes to prevent cold starts
 */

const https = require('https');

// Your Render app URL
const WEBSITE_URL = 'https://simple-blogging-platform-iakn.onrender.com';

// Ping interval: 14 minutes (840,000 ms) - just before 15-minute sleep
const PING_INTERVAL = 14 * 60 * 1000;

/**
 * Ping the website to keep it active
 */
function pingWebsite() {
    const url = new URL(WEBSITE_URL);
    
    const options = {
        hostname: url.hostname,
        port: 443,
        path: '/',
        method: 'GET',
        timeout: 30000 // 30 second timeout
    };

    const req = https.request(options, (res) => {
        console.log(`✅ Ping successful - Status: ${res.statusCode} - ${new Date().toISOString()}`);
    });

    req.on('error', (error) => {
        console.error(`❌ Ping failed: ${error.message} - ${new Date().toISOString()}`);
    });

    req.on('timeout', () => {
        console.error(`⏰ Ping timeout - ${new Date().toISOString()}`);
        req.destroy();
    });

    req.end();
}

/**
 * Start the keep-alive service
 */
function startKeepAlive() {
    console.log(`🚀 Keep-alive service started for ${WEBSITE_URL}`);
    console.log(`⏱️  Pinging every ${PING_INTERVAL / 60000} minutes`);
    
    // Initial ping
    pingWebsite();
    
    // Set up recurring pings
    setInterval(pingWebsite, PING_INTERVAL);
}

// Start the service
startKeepAlive();

// Handle process termination gracefully
process.on('SIGINT', () => {
    console.log('\n🛑 Keep-alive service stopped');
    process.exit(0);
});

process.on('SIGTERM', () => {
    console.log('\n🛑 Keep-alive service terminated');
    process.exit(0);
});