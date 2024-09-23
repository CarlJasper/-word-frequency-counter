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



