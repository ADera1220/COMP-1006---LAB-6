
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>COMP1006 - Week 4 - Let's Connect </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Piedra&family=Quicksand&display=swap" rel="stylesheet">
    <!-- Compiled and minified JavaScript -->
    <link href="main.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <header>
      <h1> TuneShare - Share Your Fave Tunes & Join The Community </h1>
    </header>
    <main>
        <?php

//create variables to store form data
$first_name = filter_input(INPUT_POST, 'fname');
$last_name = filter_input(INPUT_POST, 'lname');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

//set up a flag variable

$ok = true;


//validate
// first name and last name not empty

if (empty($first_name) || empty($last_name)) {
    echo "<p class='error'>Please provide both first and last name! </p>";
    $ok = false;
}

//email not empty and proper format
if (empty($email) || $email === false) {
    echo "<p class='error'>Please include your email in the proper format!</p>";
    $ok = false;
}


//if form validates, try to connect to database and add info

if ($ok === true) {
    try {
      
        // runs the 'connect.php' file to open a connection to the database
        require_once('connect.php');

        // this creates a variable to hold SQL statement to add data into the table
        $sql = "INSERT INTO persons(email, first_name, last_name) VALUES (:email, :firstname, :lastname);"; // what is missing here?

        //This uses the PDO object method "prepare()" to create a PDOState,emt object with the SQL statement inside
        $statement = $db->prepare($sql); // fill in the correct method

        // this binds the values of the fields to the parameters in the SQL statement
        $statement->bindParam(':firstname', $first_name);
        $statement->bindParam(':lastname', $last_name);
        $statement->bindParam(':email', $email);

        //executes the SQL query
        $statement->execute(); // fill in the correct method

        // show message
        echo "<p> Song added! Thanks for sharing! </p>";

        //closes the database connection
       $statement -> closeCursor(); // fill in the correct method


    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        //show error message to user
        echo "<p> Sorry! We weren't able to process your submission at this time. We've alerted our admins and will let you know when things are fixed! </p> ";
        echo $error_message;
        //email app admin with error
        mail('200422676@student.georgianc.on.ca', 'TuneShare Error', 'Error :'. $error_message);
    }
}
?>
    <a href="index.php" class="error-btn"> Back to Form </a>
    </main>
    <footer>
      <p> &copy; 2020 Lab Five </p>
    </footer>
   </div><!--end container-->
  </body>
</html>