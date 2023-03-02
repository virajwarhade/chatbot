


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>demo</title>

    
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">





</head>
<body>

<form method='get'>


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          ChatBot
        </div>
        <div class="card-body">
          <div class="chat-box" id="chat-box">
          


            <div class="incoming-message">
              <p>
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
</p>
            </div>

          </div>
          <form id="chat-form">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Type your message here" aria-label="Type your message here" name="question">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit" name="submit">Send</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>








</form>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>



</body>
</html>
