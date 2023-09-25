<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Word Frequency Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h1>Word Frequency Results</h1>
    <div class="container">
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

        // Sanitize and validate user inputs
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $inputText = trim($_POST['text']);
            $selectedSortOrder = isset($_POST['sort']) && ($_POST['sort'] === 'asc' || $_POST['sort'] === 'desc') ? $_POST['sort'] : 'asc';
            $selectedLimit = isset($_POST['limit']) && is_numeric($_POST['limit']) ? (int)$_POST['limit'] : 10;

            // Tokenize the input text into words
            $words = str_word_count($inputText, 1);

            // Calculate word frequency
            $wordFrequency = calculateWordFrequency($words, ['the', 'and', 'in']);

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
                $frequency = htmlspecialchars($frequency);
                echo "<tr><td>$word</td><td>$frequency</td></tr>";
            }
            echo '</table>';
        }
        ?>
    </div>
</body>
</html>