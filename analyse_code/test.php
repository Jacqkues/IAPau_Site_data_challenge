<?php

function getFilesFromGitHubRepository($repositoryUrl)
{
    // Extract the owner and repository name from the URL
    $regex = '#https?://github.com/([^/]+)/([^/]+)/?#i';
    preg_match($regex, $repositoryUrl, $matches);

    if (count($matches) !== 3) {
        // Invalid repository URL
        return null;
    }

    $owner = $matches[1];
    $repository = $matches[2];

    $apiUrl = "https://api.github.com/repos/{$owner}/{$repository}/contents";

    // Set up the cURL session
    $ch = curl_init();

    // Set the URL
    curl_setopt($ch, CURLOPT_URL, $apiUrl);

    // Set the User-Agent header
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');

    // Return the response instead of outputting it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Close the cURL session
    curl_close($ch);

    // Check if the request was successful
    if ($response === false) {
        // Error handling
        return null;
    }

    // Decode the JSON response
    $data = json_decode($response, true);

    // Check if decoding was successful
    if ($data === null) {
        // Error handling
        return null;
    }

    // Array to store the file paths and raw content URLs
    $filesData = [];

    // Iterate through the response data
    foreach ($data as $item) {
        if (isset($item['path'])) {
            $filePath = $item['path'];

            // Generate the raw content URL for the file
            $rawContentUrl = "https://raw.githubusercontent.com/{$owner}/{$repository}/main/{$filePath}";

            // Add the file path and raw content URL to the array
            $filesData[] = [
                'path' => $filePath,
                'rawUrl' => $rawContentUrl,
            ];
        }
    }

    return $filesData;
}

// Usage example
$repositoryUrl = "https://github.com/render-examples/flask-hello-world";
$files = getFilesFromGitHubRepository($repositoryUrl);

if ($files !== null) {
    foreach ($files as $fileData) {
        $extension = explode('.', $fileData['path'])[1];
        if ($extension == "py") {
            echo "File: " . $fileData['path'] . PHP_EOL;
            echo "Raw Content URL: " . $fileData['rawUrl'] . PHP_EOL . PHP_EOL;
        }

    }
} else {
    echo "Error retrieving files from the GitHub repository.";
}
?>