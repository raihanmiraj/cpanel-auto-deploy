Barik
<?php
$secret = 'cpanel_auto_deploy'; // Your GitHub webhook secret

// Get the payload and headers
$payload = file_get_contents('php://input');
$headers = getallheaders();

// Verify the signature
if (isset($headers['X-Hub-Signature-256'])) {
    $signature = $headers['X-Hub-Signature-256'];
    $hash = 'sha256=' . hash_hmac('sha256', $payload, $secret);

    // Check if the hashes match
    if (!hash_equals($hash, $signature)) {
        http_response_code(403);
        exit('Invalid signature');
    }
} else {
    http_response_code(403);
    exit('No signature header found');
}

// Proceed with deployment if valid
shell_exec('cd /path/to/your/repository && ./deploy.sh 2>&1');
http_response_code(200);
echo 'Deployment completed.';
