<?php require_once('header.php'); ?>
<h1> COMP1006 - Lab Nine</h1>
<main>
<?php

  //initialize variables
  $id = null;
  $first_name = null;
  $last_name = null;
  $email = null;

  if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    //grab the id from the URL
    $id = filter_input(INPUT_GET, 'id');

    //connect to the database
    require_once('connect.php');

    //set up the SQL query
    $sql = "SELECT * FROM persons WHERE user_id = :user_id;";

    //prepare our statement
    $statement = $db->prepare($sql);

    //bind
    $statement->bindParam(':user_id', $id);

    //execute
    $statement->execute();

    //use fetchAll to store
    $records = $statement->fetchAll();

    //to loop through, use a foreach
    foreach($records as $record) :
      $first_name = $record['first_name'];
      $last_name = $record['last_name'];
      $email = $record['email'];
    endforeach;

    //close the connection
    $statement->closeCursor();
  }

  ?>
  <form action="process.php" method="post">
    <label for="username"> Choose a Username please  </label>
    <input type="text" name="username" class="form-control" id="username">
    <label for="password"> Enter A Password  </label>
    <input type="password" name="password" class="form-control" id="password">
    <label for="confirm"> Confirm Your Password  </label>
    <input type="password" name="confirm" class="form-control" id="confirm">
    <label for="fname"> Your First Name  </label>
    <input type="text" name="fname" class="form-control" id="fname">
    <label for="lname"> Your Last Name  </label>
    <input type="text" name="lname" class="form-control" id="lname">
    <label for="email"> Your Email </label>
    <input type="email" name="email" class="form-control" id="email">
    <input type="submit" name="submit" value="Send & Share" class="btn">
  </form>
  </main>
  <?php require_once('footer.php'); ?>