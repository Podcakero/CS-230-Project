<?php 

require 'includes/header.php'; 

?>


<form method="POST" role="form" id="form" action="result.php">
    <link rel="stylesheet" href="css/quiz.css">
    <?php
         require 'includes/dbhandler.php';
    
          $sql="SELECT * FROM AddQuestion ORDER BY id";
          $stmt=$conn->query($sql);
          $i = 1;
          $question_rowcount = $stmt->rowCount();
          foreach ($stmt as $row){
            $question_id = $row['id'];
              $questions = $row['Qtitle'];
               $optionA = $row['A1'];
               $optionB = $row['A2'];
               $optionC= $row['A3'];
               $optionD = $row['A4'];
            
         ?>
         
      <div id='question<?php echo $i;?>' class='cont'>
        <div class="form-group">
            <label style="font-weight: normal; text-align: justify;"
                class="questions mt-1 mt-2"><b><?php echo "Question " . " " . $i ." "; ?></b><?php echo $questions; ?></label><br>
            <div id="quiz-options">
                <label style="font-weight: normal; cursor: pointer;">
                    <label class="btn btn-1"><input type= "radio" name="statusSelect" value=<?php echo ''.$row['A1'].''?>> <?php echo $optionA; ?>
                </label><br>
                <label style="font-weight: normal; cursor: pointer;">
                    <label class="btn btn-1"><input type= "radio" name="statusSelect" value=<?php echo ''.$row['A2'].''?>> <?php echo $optionB; ?>
                </label><br>
                <label style="font-weight: normal; cursor: pointer;">
                    <label class="btn btn-1"><input type= "radio" name="statusSelect" value=<?php echo ''.$row['A3'].''?>> <?php echo $optionC; ?>
                </label><br>
                <label style="font-weight: normal; cursor: pointer;">
                    <label class="btn btn-1"><input type= "radio" name="statusSelect" value=<?php echo ''.$row['A4'].''?>> <?php echo $optionD; ?>
                </label><br>
                <?php 
                //First question, only display next button
                if($i==1){?>
                <button id='next <?php echo $i;?>' class='next btn btn-default pull-right' type='button'>Next</button>

            </div>
        </div>
    </div>
    <?php }
    //Middle questions, display previous and next buttons
    elseif($i<$question_rowcount){?>

                <button id='pre <?php echo $i;?>' class='previous btn btn-default' type='button'>Previous</button>
                <button id='next  <?php echo $i;?>' class='next btn btn-default pull-right' type='button'>Next</button>
            </div>
        </div>
    </div>
    <?php }
    //Final question, display previous and submit button
    elseif( $i == $question_rowcount ){?>
    
                    <button id='pre <?php echo $i;?>' class='previous btn btn-default' type='button'>Previous</button>
                    <button class='submit btn btn-default' name="quiz-submit" onclick="submit">Submit Quiz</button>
            </div>
        </div>
    </div>
    <?php }
   
        $i++;} ?>
    </link>
</form>

<script>

//Hide and display questions based on id
     var arr = [];
      var total = <?php echo $question_rowcount; ?>;

    
   $('.cont').addClass('hide');
 $('#question'+1).removeClass('hide');
//User clicks 'next'
 $(document).on('click','.next',function(){
     element=$(this).attr('id');
     $("input[type='submit']").hide();
     last = parseInt(element.substr(5),10);
     if (total == last){
      $("input[type='submit']").show();
     }
     nex=last + 1;
     //Hide last question and display current one
     $('#question' + last).addClass('hide');
     console.log(element);

     $('#question' + nex).removeClass('hide');
 });
//User clicks 'previous'
 $(document).on('click','.previous',function(){
     element=$(this).attr('id');
     last = parseInt(element.substr(element.length - 1),10);
     pre=last - 1;
     $('#question' + last).addClass('hide');

     $('#question' + pre).removeClass('hide');
 });


//This function makes it so only one button can be selected at a time
function responderChangeStatus(elem) {
    var btnEl = document.querySelectorAll('.statusSelect');
    for (var i = 0; i < btnEl.length; i++) {
        btnEl[i].classList.remove('Selected');
    }
    elem.classList.add('Selected');
    return;
}



</script>