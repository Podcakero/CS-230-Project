<html>
 
<head>
	<meta charset=UTF-8" />

	
	<link rel="stylesheet" type="quiz/css" href="style.css" />
</head>
 
<body>
 
	<div id="page-wrap">
 
		<h1>Video Game Result</h1>
		
        <?php
            $arr=array();
            array_push($arr, "apple", "orange");
            echo ''. $arr.'';
            $answer1 = $_POST['question-1-answers'];

            $answer2 = $_POST['question-2-answers'];
            $answer3 = $_POST['question-3-answers'];
            $answer4 = $_POST['question-4-answers'];
            $answer5 = $_POST['question-5-answers'];
        
            $totalCOD = 0;
            
            if ($answer1 == "A") { $COD++; }
            if ($answer2 == "A") { $COD++; }
            if ($answer3 == "A") { $COD++; }
            if ($answer4 == "A") { $COD++; }
            if ($answer5 == "A") { $COD++; }
            
            echo "<div id='results'>You got Call of Duty!</div>";
            
        ?>
	
	</div>
 
</body>
 
</html>