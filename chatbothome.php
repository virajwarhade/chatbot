<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>demo</title>
</head>
<body>

<form method='get'>
<input type="text" name="question" >
<input type="submit" name="submit" >
</form>


    <?php
if(isset($_GET['submit'])){
    // Define the delimiter used in the data file
    $delimiter = "\t";

    // Load the data file into an array
    $data = file('mydata.txt');

    // Parse the data file and create a dictionary of questions and answers
    $qa_dict = array();
    foreach ($data as $line) {
        $parts = explode($delimiter, trim($line));
        if (count($parts) >= 2) {
            $question = strtolower($parts[0]);
            $answer = $parts[1];
            $qa_dict[$question] = $answer;
        }
    }

    // Get the user's question from the input
    $user_question = strtolower($_GET['question']);

    // Use NLP to find the best matching question from the dictionary
    $best_match = "";
    $best_match_score = -1;
    foreach ($qa_dict as $question => $answer) {
        similar_text($user_question, $question, $score);
        if ($score > $best_match_score) {
            $best_match = $question;
            $best_match_score = $score;
        }
    }

    // If a matching question is found, return the corresponding answer
    if ($best_match_score > 50) {
        $answer = $qa_dict[$best_match];
        echo $answer;
    }
    else {
        echo "Sorry, I couldn't find an answer to your question.";
    }
}
    ?>
</body>
</html>
