<?php require_once('header.php'); ?>
<h1> COMP1006 - Lab Five</h1>
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
        <!-- add hidden input with user_id if editing -->
        <input type="hidden" name="user_id" value="<?php echo $id; ?>">
        <label for="fname"> Your First Name  </label>
        <input type="text" name="fname" class="form-control" id="fname" value="<?php echo $first_name; ?>">
        <label for="lname"> Your Last Name  </label>
        <input type="text" name="lname" class="form-control" id="lname" value="<?php echo $last_name; ?>">
        <label for="email"> Your Email </label>
        <input type="email" name="email" class="form-control" id="email" value="<?php echo $email; ?>">
        <input type="submit" name="submit" value="Send & Share" class="btn">
      </form>
</main>
<?php require_once('footer.php'); ?>