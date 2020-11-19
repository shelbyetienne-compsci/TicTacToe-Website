
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tic Tac Toe</title>
  <style>
  *{
    margin:0;
    padding:0;
  }
  input{
    transition-duration: .2s;
    background-color: #355C7D;
    border: none;
    height: 100px;
    width: 100px;
    text-align: center;
    color: #F8B195;
    font-size: 16px;
  }
  input:hover{
    background-color: #F8B195;
    opacity: 0.5;
    color: #355C7D
  }
  a:hover{
    background-color: #F8B195;
    opacity: 0.5;
    color: #355C7D  
  }
  #res:hover a{
    color: #355C7D  
  } 
  #box1{
    margin-right:1px;
    margin-left:1px;
  }
  #box3{
    margin-top:1px;
    margin-bottom:1px;
  }
  #box4{
    margin:1px;
  }
  #box5{
    margin-top:1px;
    margin-bottom:1px;
  }
  #box7{
    margin-right:1px;
    margin-left:1px;
  }
  .bg{
    height:100vh;
    background: linear-gradient(#F8B195,#355C7D);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  #game{
    justify-content: center;
  }

  #game p{
    text-align: center;
    width: 100px;
    margin-left: 100px;
    color: #355C7D;
  }
  #sub{
    margin-top:1px;
    margin-left:100px;
  }
  #res{
    margin-top:1px;
  }
  a{
    text-decoration: none;
    color: #F8B195;
    height:100px;
    width: 100px;
    margin-left:100px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #355C7D;
  }
  header{
    display: flex;
    height: 30px;
    background-color: #F8B195;
    align-items: center;
    justify-content: center;
    color: #355C7D;
  }
  #llevel{

  }
  #level{
    margin-left: 50px;
    height: 25px;
    length: 200px;
  }
  #buttn{
    border: none;
    background-color: #F8B195;
    height: 25px;
    width: 70px; 
    color: #355C7D;
  }

  #buttn:hover{
    background-color: #C06C84;
    color: #355C7D;
  }
  ::placeholder{
    font-size:11px;
    color: #C06C84;
  }
  </style>
</head>
<body>
  <header>
    <h2>Tic Tac Toe</h2>
  </header>
  <main class="bg">
    <form  id="game" name="tictactoe" method="post" action="index.php">
    <?php 
        $temp = 0;
        $move = moves($temp);
        $winner = "n";
        $boxes = array("","","","","","","","","");
        $levels = "";
      
        if(isset($_POST["levels"]))//submit level gets pressed
        {
          $levels = $_POST["levels"];
        }

        //isset checks to see whether a variable has been set to something
        if(isset($_POST["submitButton"]))//enter is pressed
        {
          //sets boxes to value entered
          $boxes[0] = $_POST["box0"];
          $boxes[1] = $_POST["box1"];
          $boxes[2] = $_POST["box2"];
          $boxes[3] = $_POST["box3"];
          $boxes[4] = $_POST["box4"];
          $boxes[5] = $_POST["box5"];
          $boxes[6] = $_POST["box6"];
          $boxes[7] = $_POST["box7"];
          $boxes[8] = $_POST["box8"];
          $levels = $_POST["levels"];

          //check if x wins
          if( $boxes[0]=="x" && $boxes[1]=="x" && $boxes[2]=="x" OR 
              $boxes[3]=="x" && $boxes[4]=="x" && $boxes[5]=="x" OR
              $boxes[6]=="x" && $boxes[7]=="x" && $boxes[8]=="x" OR
              $boxes[0]=="x" && $boxes[3]=="x" && $boxes[6]=="x" OR
              $boxes[1]=="x" && $boxes[4]=="x" && $boxes[7]=="x" OR
              $boxes[2]=="x" && $boxes[5]=="x" && $boxes[8]=="x" OR
              $boxes[0]=="x" && $boxes[4]=="x" && $boxes[8]=="x" OR
              $boxes[2]=="x" && $boxes[4]=="x" && $boxes[6]=="x")
              {
                $winner = "x";
                print("<p>X Wins</p>");
              }
              
          #Comp checks for open box
          $blank = 0;
          for($i=0;$i<9;$i++)
          {
            if($boxes[$i] == "")
            {
              $blank = 1;
            }
          }

          if($blank == 1 && $winner =="n")
          {
            //comp brain
            $i = rand(0,8);
            if($levels == "easy" || $levels == "e")
              $boxes[easyAi($i)] = "o";
            if($levels == "medium" || $levels == "m")
              $boxes[mediumAi($i)] = "o";
            if($levels == "hard" || $levels == "h")
              $boxes[hardAi($i)] = "o";

            //check if o wins
            if( $boxes[0]=="o" && $boxes[1]=="o" && $boxes[2]=="o" OR 
            $boxes[3]=="o" && $boxes[4]=="o" && $boxes[5]=="o" OR
            $boxes[6]=="o" && $boxes[7]=="o" && $boxes[8]=="o" OR
            $boxes[0]=="o" && $boxes[3]=="o" && $boxes[6]=="o" OR
            $boxes[1]=="o" && $boxes[4]=="o" && $boxes[7]=="o" OR
            $boxes[2]=="o" && $boxes[5]=="o" && $boxes[8]=="o" OR
            $boxes[0]=="o" && $boxes[4]=="o" && $boxes[8]=="o" OR
            $boxes[2]=="o" && $boxes[4]=="o" && $boxes[6]=="o")
            {
              $winner = "o";
              print("<p>O Wins</p>");
            } 
          } 
          else if($winner == "n")
          {
            $winner = "t";
            print("<p>Tie!</p>");
          }
        }
  ?>

      <?php
        //prints 9 boxes
        echo "<div id='llevel'><input id='level' type='text' name='levels' value='$levels' placeholder='easy, medium, hard'>";
        echo "<button id='buttn' name='levels' type='button'>Submit Level</button> <div><br>";

        for($i=0;$i<9;$i++)
        { 
          printf ("<input id='box$i' type='text' name='box$i' value='%s'>",$boxes[$i]);
          if($i == 2|| $i == 5 || $i == 8)
          {
            echo "<br>";
          }
        }
        if($winner == "n")//prints submit until someone wins
        {
          echo "<input id='sub' type='submit' name='submitButton' value='Enter'>";
        }
        else if($winner != "n" || $levels == "")//after someone wins print restart button
        {
          echo "<div id='res'><a href='index.php'>Restart</a></div>";
        }
      ?>


      <?php 
        function hardAi(int $i)//strict declaration
        {
          global $boxes, $moves;

          $i = mediumAi($i);

          if(moves() == 1)
          {
            if($boxes[0]=="x"||$boxes[1]=="x"||$boxes[2]=="x"||$boxes[5]=="x"||$boxes[8]=="x"||$boxes[7]=="x"||$boxes[6]=="x"||$boxes[3]=="x")
            {
              $i = 4;
            }

            if($boxes[4]=="x")
            {
              $x=rand(0,3);
              if($x==0)
                $i = 6;
              else if($x==1)
                $i = 0;
              else if($x==2)
                $i = 8;
              else if($x==3)
                $i = 2;
            }
          }

          if(moves() == 3)
          {
            if($boxes[0]=="x" && $boxes[8]=="x" || $boxes[2]=="x" && $boxes[6]=="x")
            {
              if($boxes[4]=="x")
                {
                  $x=rand(0,3);
                  if($x==0)
                    $i = 3;
                  else if($x==1)
                    $i = 5;
                  else if($x==2)
                    $i = 7;
                  else if($x==3)
                    $i = 1;
                }
            }       
          }

          #horizontal
          if($boxes[0] == "o" && $boxes[1] == "o" && $boxes[2] == "")
            $i = 2;
          if($boxes[2] == "o" && $boxes[1] == "o" && $boxes[0] == "")
            $i = 0;
          if($boxes[2] == "o" && $boxes[0] == "o" && $boxes[1] == "")
            $i = 1;

          if($boxes[3] == "o" && $boxes[4] == "o" && $boxes[5] == "")
            $i = 5;
          if($boxes[5] == "o" && $boxes[4] == "x" && $boxes[3] == "")
            $i = 3;
          if($boxes[3] == "o" && $boxes[5] == "o" && $boxes[4] == "")
            $i = 4;

          if($boxes[6] == "o" && $boxes[7] == "o" && $boxes[8] == "")
            $i = 8;
          if($boxes[8] == "o" && $boxes[7] == "o" && $boxes[6] == "")
            $i = 6;
          if($boxes[6] == "o" && $boxes[8] == "o" && $boxes[7] == "")
            $i = 7;


          #vertical
          if($boxes[0] == "o" && $boxes[3] == "x" && $boxes[6] == "")
            $i = 6;
          if($boxes[6] == "o" && $boxes[3] == "o" && $boxes[0] == "")
            $i = 0;
          if($boxes[0] == "o" && $boxes[6] == "o" && $boxes[3] == "")
            $i = 3;

          if($boxes[1] == "o" && $boxes[4] == "o" && $boxes[7] == "")
            $i = 7;
          if($boxes[7] == "o" && $boxes[4] == "o" && $boxes[1] == "")
            $i = 1;
          if($boxes[1] == "o" && $boxes[7] == "o" && $boxes[4] == "")
            $i = 4;

          if($boxes[2] == "o" && $boxes[5] == "o" && $boxes[8] == "")
            $i = 8;
          if($boxes[8] == "o" && $boxes[5] == "o" && $boxes[2] == "")
            $i = 2;
          if($boxes[2] == "o" && $boxes[8] == "o" && $boxes[5] == "")
            $i = 5;


          #diagonal
          if($boxes[0] == "o" && $boxes[4] == "o" && $boxes[8] == "")
            $i = 8;
          if($boxes[8] == "o" && $boxes[4] == "x" && $boxes[0] == "")
            $i = 0;
          if($boxes[0] == "o" && $boxes[8] == "x" && $boxes[4] == "")
            $i = 4;

          if($boxes[2] == "o" && $boxes[4] == "o" && $boxes[6] == "")
            $i = 6;
          if($boxes[6] == "o" && $boxes[4] == "o" && $boxes[2] == "")
            $i = 2;
          if($boxes[2] == "o" && $boxes[6] == "o" && $boxes[4] == "")
            $i = 4;


          return $i;
        }

        function mediumAi(int $i)
        {
          global $boxes, $moves;

          $i = rand(0,8);

          #horizontal
          if($boxes[0] == "x" && $boxes[1] == "x" && $boxes[2] == "")
            $i = 2;
          if($boxes[2] == "x" && $boxes[1] == "x" && $boxes[0] == "")
            $i = 0;
          if($boxes[2] == "x" && $boxes[0] == "x" && $boxes[1] == "")
            $i = 1;

          if($boxes[3] == "x" && $boxes[4] == "x" && $boxes[5] == "")
            $i = 5;
          if($boxes[5] == "x" && $boxes[4] == "x" && $boxes[3] == "")
            $i = 3;
          if($boxes[3] == "x" && $boxes[5] == "x" && $boxes[4] == "")
            $i = 4;

          if($boxes[6] == "x" && $boxes[7] == "x" && $boxes[8] == "")
            $i = 8;
          if($boxes[8] == "x" && $boxes[7] == "x" && $boxes[6] == "")
            $i = 6;
          if($boxes[6] == "x" && $boxes[8] == "x" && $boxes[7] == "")
            $i = 7;


          #vertical
          if($boxes[0] == "x" && $boxes[3] == "x" && $boxes[6] == "")
            $i = 6;
          if($boxes[6] == "x" && $boxes[3] == "x" && $boxes[0] == "")
            $i = 0;
          if($boxes[0] == "x" && $boxes[6] == "x" && $boxes[3] == "")
            $i = 3;

          if($boxes[1] == "x" && $boxes[4] == "x" && $boxes[7] == "")
            $i = 7;
          if($boxes[7] == "x" && $boxes[4] == "x" && $boxes[1] == "")
            $i = 1;
          if($boxes[1] == "x" && $boxes[7] == "x" && $boxes[4] == "")
            $i = 4;

          if($boxes[2] == "x" && $boxes[5] == "x" && $boxes[8] == "")
            $i = 8;
          if($boxes[8] == "x" && $boxes[5] == "x" && $boxes[2] == "")
            $i = 2;
          if($boxes[2] == "x" && $boxes[8] == "x" && $boxes[5] == "")
            $i = 5;


          #diagonal
          if($boxes[0] == "x" && $boxes[4] == "x" && $boxes[8] == "")
            $i = 8;
          if($boxes[8] == "x" && $boxes[4] == "x" && $boxes[0] == "")
            $i = 0;
          if($boxes[0] == "x" && $boxes[8] == "x" && $boxes[4] == "")
            $i = 4;

          if($boxes[2] == "x" && $boxes[4] == "x" && $boxes[6] == "")
            $i = 6;
          if($boxes[6] == "x" && $boxes[4] == "x" && $boxes[2] == "")
            $i = 2;
          if($boxes[2] == "x" && $boxes[6] == "x" && $boxes[4] == "")
            $i = 4;

            while($boxes[$i] != "")
            {
              $i = rand(0,8);
            }
          
          return $i;
        }

        function easyAi(int $i)
        {
          global $boxes;
          
          $i = rand(0,8);
          while($boxes[$i] != "")
          {
            $i = rand(0,8);
          }
          return $i;
        }

        function moves(int $x=0)
        {
          global $boxes;
          
          $x = 0;

          for($i=0;$i<9;$i++)
          {
            if($boxes[$i]!="")
              $x+=1;
          }

          return $x;
        }
      ?>
    </form>
  </main>
</body>
</html>