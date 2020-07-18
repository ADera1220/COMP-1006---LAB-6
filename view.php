<?php require_once('auth.php'); ?>
<?php require_once('header.php'); ?>
<h1> COMP1006 - Lab Nine</h1>
<main>
    <?php
        try {
            //connect to db
            require_once('connect.php');

            //set up SQL statement
            $sql = "SELECT * FROM persons;";

            //prepare the query
            $statement = $db->prepare($sql);

            //execute
            $statement->execute();

            //fetchAll to store the results
            $records = $statement->fetchAll();

            //echo out the top of the table
            echo "<table class='table'><thead class='table table-dark'><th>First Name</th><th>Last Name</th><th>Email</th><th>Delete</th><th>Edit</th></thead><tbody>";

            foreach($records as $record) {
                echo 
                "<tr><td>".$record['first_name'].
                "</td><td>".$record['last_name'].
                "</td><td>".$record['email'].
                "</td><td><a href='delete.php?id=".$record['user_id'].
                "'>Delete</a></td><td><a href='index.php?id=".$record['user_id'].
                "'>Edit</a></td></tr>";
            }

            echo "</tbody></table>";

            $statement->closeCursor();
        }
        catch(PDOException $e){
            $err_msg = $e->getMessage();
            echo "<p>$err_msg</p>";
        }
    ?>
</main>
<?php require_once('footer.php'); ?>