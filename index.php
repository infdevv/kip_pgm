<?php

// Function to find and return the content of the corresponding Python file
function findAndEchoPythonCode($requestedItem) {
    $indexFile = 'index.txt';

    // Check if the index file exists
    if (file_exists($indexFile)) {
        // Open the index file for reading
        $file = fopen($indexFile, 'r');

        // Read each line from the index file
        while (($line = fgets($file)) !== false) {
            // Trim whitespace from the line
            $line = trim($line);

            // Check if the requested item matches the current line
            if ($line === $requestedItem) {
                // Close the index file
                fclose($file);

                // Construct the path to the Python file
                $pythonFilePath = $requestedItem . '.py';

                // Check if the Python file exists
                if (file_exists($pythonFilePath)) {
                    // Read and echo the content of the Python file
                    $pythonCode = file_get_contents($pythonFilePath);
                    echo $pythonCode;
                } else {
                    // Output a message if the Python file is not found
                    echo "Python file not found for item: $requestedItem";
                }

                return; // Exit the function after echoing the code
            }
        }

        // Close the index file
        fclose($file);
    }

    // Output a message if the requested item is not found
    echo "Item not found in index.txt";
}

// Example usage: assuming the item is passed as a query parameter named 'item'
$item = isset($_GET['item']) ? $_GET['item'] : '';

// Check if the item is provided
if (!empty($item)) {
    // Find and echo the content of the corresponding Python file
    findAndEchoPythonCode($item);
} else {
    // Output a message indicating that the item parameter is missing
    echo "Item parameter is missing";
}

?>
