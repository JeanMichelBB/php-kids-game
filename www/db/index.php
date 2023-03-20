<?php
/**
 *Demonstration 
 *Connect a script to MySQL using MySQLi
 *Using OOP (Classes, Properties, Methods, and Objects)  
*/
?>
<!DOCTYPE html>
<html>

<head>
  <title>Question</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <h1 class="blueText">Registration Form</h1>
    <hr>
    <!--Form-->
    <form id="form1" method="post" action="main.php">
      <table>
        <tr>
          <th><label for=input1>First Name</label></th>
          <td><input id=input1 type="text" name="fname" required="required"></td>
        </tr>
        <tr>
          <th><label for=input2>Last Name</label></th>
          <td><input id=input2 type="text" name="lname" required="required"></td>
        </tr>
        <tr>
          <th><label for=input4>Username</label></th>
          <td><input id=input4 type="text" name="username" required="required"></td>
        </tr>
        <tr class="submit">
          <td></td>
          <td><input id="submit1" type="submit" name="send" value="SEND" /></td>
        </tr>
      </table>
    </form>
  </div>
</body>

</html>