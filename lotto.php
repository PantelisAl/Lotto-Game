<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/style.css">
    <title>Lotto</title>
</head>
<body>

    <div class="logo">
         <img src="https://recipebook.gr/wp-content/uploads/2021/01/clipart2665430-1.png" alt="logo lotto" class="logo" id="logo">
         <h1 class="title">Select 6 numbers and press "Play"</h1>
    </div>

    <div class="lotaria" id="lotaria" align="center">
        <div id="forma" class="forma_1">
            <form action="#" method="POST">
             <div class="numbers-container">
                <?php
                    for($i=1; $i<=49; $i++){
                        $checked = "";

                        if(!empty($_POST['lotto_numbers_user'])){
                            foreach($_POST['lotto_numbers_user'] as $arithmoi){
                                if ($i == $arithmoi){
                                    $checked = "checked";
                                }
                            }
                        }
                     echo '<input type="checkbox" '.$checked.' id="lotto_numbers_user_'. $i .'" class="lotto_numbers_user" name="lotto_numbers_user[]" value='.$i.'>'; 
                     echo '<label for="lotto_numbers_user_'. $i.'">' . $i . '</label>';
                    }
                    echo '<br><br>';
                    echo '<input class="button" type="submit" value="Play">';  
                ?>
             </div>
            </form>
        </div>

        <?php
            if(!empty($_POST['lotto_numbers_user']) && is_array($_POST['lotto_numbers_user'])){
               $selected_numbers = $_POST['lotto_numbers_user'];
               if(count($selected_numbers) !== 6){
                    echo "<div id='alert' class='result error'>You must select 6 numbers </div>"; 
               }else{
                      echo "<b><br><br><p class='result'><b>Your selection is:</b><br>".implode("-",$selected_numbers)."</p><br><br>";
                        $random_array = [];
                        $i = 0;
                        while($i < 6){
                            $rand_number = rand(1,49);
                            if(!in_array($rand_number,$random_array)){
                                array_push($random_array,$rand_number);
                                $i++;
                            } 
                        }

                        sort($random_array);
                        $rand_numbers_new = " ";
                        echo "<br><p class='result'><b>The lucky numbers are:</b><br>".implode("-",$random_array)."</p><br><br>";
                     
                        $winning_array = [];
                        for($i=0; $i<6; $i++){
                           if (in_array($selected_numbers[$i],$random_array)){
                                 array_push($winning_array,$selected_numbers[$i]);  
                           }
                        }
            
                       if(count($winning_array) == 0){
                          echo "<p class='result error' style='color:red;'>Sorry, try again!</p>";
                       }else{
                          echo "<p class='result'><b>Numbers you guessed:</b><br>".implode("-",$winning_array)."</p>";
                        
                       }

                       echo "<br><br><a href='lotto.php'><button class='button'>Reset</button></a>";             
                }
                echo "</div>";
            }
        ?>
    </div>

</body>
</html>