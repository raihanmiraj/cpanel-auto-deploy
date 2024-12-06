
<?php
 
$repo_path = '/home/xmbpkbwb/public_html';
$branch = 'main'; // Replace with your branch name

// Execute git pull and log output
$output = [];
exec("cd $repo_path && git reset --hard && git pull origin $branch 2>&1", $output);

// Log output for debugging
file_put_contents('/home/xmbpkbwb/public_html/deploy.log', implode(PHP_EOL, $output), FILE_APPEND);

// Respond to GitHub webhook
http_response_code(200);
echo "Deployed Successfully";
?>
