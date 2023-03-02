<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>generate q</title>
</head>
<body>
    
<?php
// Load the answers from the file
$answers = file('myans.txt', FILE_IGNORE_NEW_LINES);

// Define the regular expression pattern to match the answer content
$pattern = '/(.+)/';

// Loop through the answers
foreach ($answers as $answer) {

    // Find the matches in the answer content
    preg_match($pattern, $answer, $matches);

    // Generate the question from the matches
    if (count($matches) == 2) {
        $question = "What is " . $matches[1] . "?";

        // Append the question and answer to the file
        $file = fopen('mydata.txt', 'a');
        fwrite($file, strtolower($question) . "\t" . $answer . "\n");
        fclose($file);

        // Remove the processed answer from the file
        $new_answers = array_diff($answers, array($answer));
        file_put_contents('myans.txt', implode("\n", $new_answers));
    }
}

?>

</body>
</html>