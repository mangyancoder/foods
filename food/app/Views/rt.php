<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      if(isset($_POST['compute'])){
      $name = $_POST['name'];
      $english = $_POST['english'];
      $math = $_POST['math'];
      $science = $_POST['science'];
      $filipino = $_POST['filipino'];
      $pe = $_POST['pe'];
      $rm = $_POST['rm'];
      $comprog = $_POST['comprog'];
      $ave = ($english + $math + $science + $filipino + $pe + $rm+ $comprog) /7;
      if($ave >= 75){
        echo 'hi ' .$name .', ' . 'your grade is :' . $ave . 'and you are passed';
      }else{
        echo 'hi ' .$name .', ' . 'your grade is :'.  $ave . 'and you are failed';
      }
    } ?>
    <form method="post" action="">
    <label>Student Name</label>
    <input type="text" name="name" placeholder="Students name">
    <br>
    <label>english</label>
    <input type="number" name="english" placeholder="english grade">
    <br>
    <label>math</label>
    <input type="number" name="math" placeholder="math grade">
    <br>
    <label>science</label>
    <input type="number" name="science" placeholder="science grade">
    <br>
    <label>filipino</label>
    <input type="number" name="filipino" placeholder="filipino grade">
    <br>
    <label>pe</label>
    <input type="number" name="pe" placeholder="pe grade">
    <br>
    <label>research method</label>
    <input type="number" name="rm" placeholder="rm grade">
    <br>
    <label>comprog</label>
    <input type="number" name="comprog" placeholder="comprog grade">
    <br>
    <input type="submit" name="compute" value="compute">
  </form>
  </body>
</html>
