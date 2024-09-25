<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Word Frequency Counter</title>
    <link rel="stylesheet" type="text/css" href="styles.css">



</head>
<body>
    <h1>Word Frequency Counter</h1>
    

    <form action="process.php" method="post">

    <form action="" method="post">

        <label for="text">Paste your text here:</label><br>
        <textarea id="text" name="text" rows="10" cols="50" required></textarea><br><br>
        
        <label for="sort">Sort by frequency:</label>
        <select id="sort" name="sort">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select><br><br>
        
        <label for="limit">Number of words to display:</label>
        <input type="number" id="limit" name="limit" value="10" min="1"><br><br>
        
        <input type="submit" value="Calculate Word Frequency">
    </form>

</body>
</html>

<?php
function getStopWords() {
    return ['the', 'and', 'in', 'to', 'of', 'a', 'is', 'it', 'you', 'that', 'with', 'for', 'on', 'as', 'are', 'this', 'by'];
}

function tokenizeText($text) {

    $text = strtolower($text);
    $text = preg_replace('/[^\w\s]/', '', $text);
    return explode(' ', $text);
}

function calculateWordFrequency($words, $stopWords) {
    $filteredWords = array_diff($words, $stopWords);
    return array_count_values($filteredWords);
}

function sortFrequency($frequencies, $order) {
    if ($order === 'desc') {
        arsort($frequencies);
    } else {
        asort($frequencies);
    }
    return $frequencies;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST['text'];
    $sortOrder = $_POST['sort'];
    $limit = intval($_POST['limit']);


    $words = tokenizeText($text);
    

    $stopWords = getStopWords();
    $frequencies = calculateWordFrequency($words, $stopWords);
    

    $sortedFrequencies = sortFrequency($frequencies, $sortOrder);
    
 
    $limitedFrequencies = array_slice($sortedFrequencies, 0, $limit, true);


    echo "<h2>Word Frequency Results</h2>";
    echo "<ul>";
    foreach ($limitedFrequencies as $word => $count) {
        echo "<li><strong>$word</strong>: $count</li>";
    }
    echo "</ul>";
} else {
    echo "Invalid request.";
}
?>





    <?php
    $stopWords = [
        "the", "and", "in", "of", "a", "to", "is", "that", "it", "on", "for", "with", "as", "was", "were", "at", "by", 
        "an", "be", "this", "which", "or", "from", "are", "but", "not", "can", "have", "has", "had", "will", "would", 
        "could", "should"
    ];

    function calculateWordFrequency($text, $stopWords) {
        $text = strtolower($text);
        $text = preg_replace('/[^\w\s]/u', '', $text);
        $words = preg_split('/\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);
        $filteredWords = array_filter($words, function ($word) use ($stopWords) {
            return !in_array($word, $stopWords);
        });
        return array_count_values($filteredWords);
    }

    function sortWordFrequency($wordFrequency, $sortOrder) {
        if ($sortOrder === 'asc') {
            asort($wordFrequency);
        } else {
            arsort($wordFrequency);
        }
        return $wordFrequency;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $text = $_POST['text'] ?? '';
        $sortOrder = $_POST['sort'] ?? 'desc';
        $limit = intval($_POST['limit']) ?? 10;

        if (empty(trim($text))) {
            echo "<h3>Error: Please provide some text for analysis.</h3>";
            exit;
        }

        $wordFrequency = calculateWordFrequency($text, $stopWords);
        $sortedWordFrequency = sortWordFrequency($wordFrequency, $sortOrder);
        $limitedWordFrequency = array_slice($sortedWordFrequency, 0, $limit, true);

        echo "<h2>Word Frequency Result</h2>";
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<thead><tr><th>Word</th><th>Frequency</th></tr></thead>";
        echo "<tbody>";
        foreach ($limitedWordFrequency as $word => $frequency) {
            echo "<tr><td>{$word}</td><td>{$frequency}</td></tr>";
        }
        echo "</tbody></table>";
    }
    ?>
</body>

