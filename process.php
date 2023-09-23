<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Word Frequency Results</title>
    <style>
        /* Your CSS styles here. */
    </style>
</head>
<body>
    <h1>Word Frequency Results</h1>

    <?php
    // Function to calculate word frequency while ignoring stop words.
    function calculateWordFrequency($words, $stopWords) {
        $wordFrequency = array_count_values($words);

        // Remove stop words from the frequency array
        foreach ($stopWords as $stopWord) {
            unset($wordFrequency[$stopWord]);
        }

        return $wordFrequency;
    }

    // Function to sort word frequency based on user's choice.
    function sortWordFrequency($wordFrequency, $sortOrder) {
        if ($sortOrder === "asc") {
            asort($wordFrequency);
        } else {
            arsort($wordFrequency);
        }
        return $wordFrequency;
    }

    // Function to limit the number of words displayed
    function limitWordFrequency($wordFrequency, $limit) {
        return array_slice($wordFrequency, 0, $limit);
    }

    // Define stop words
    $stopWords = ["the", "and", "in"]; // Common stop words to ignore

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve user input and perform input validation
        $inputText = trim($_POST['text']);
        $selectedSortOrder = $_POST['sort']; // 'asc' or 'desc'
        $selectedLimit = (int)$_POST['limit']; // Number of words to display

        // Validate input
        if (empty($inputText) || $selectedLimit <= 0) {
            echo '<p>Please enter valid input and limit.</p>';
        } else {
            // Tokenize the input text into words
            $words = str_word_count($inputText, 1);

            // Calculate word frequency
            $wordFrequency = calculateWordFrequency($words, $stopWords);

            // Sort word frequency based on user's choice
            $sortedWordFrequency = sortWordFrequency($wordFrequency, $selectedSortOrder);

            // Limit the number of words to display
            $limitedWordFrequency = limitWordFrequency($sortedWordFrequency, $selectedLimit);

            // Output the results in a styled table
            echo '<table>';
            echo '<tr><th>Word</th><th>Frequency</th></tr>';

            foreach ($limitedWordFrequency as $word => $frequency) {
                // HTML escape user-generated content
                $word = htmlspecialchars($word);
                echo "<tr><td>$word</td><td>$frequency</td></tr>";
            }

            echo '</table>';
        }
    } else {
        // Handle the case where the form is not submitted
        echo '<p>No data submitted.</p>';
    }
    ?>

</body>
</html>
