<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

  <?php
    include '../templates/head.php'
  ?>

<body>

  <?php
    include '../templates/front_carousel.php'
  ?>

  <?php
    include '../templates/navigation.php'
  ?>

  <h1> Search results: </h1>



<?php
//if(isset($_POST['submit'])){
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //echo "Yes! It works! $search";
  $search = test_input($_POST["search"]);
}

// PHP security function
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(!empty($search)) {
  try {
      include "connection.php";

      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT movie.movie_id, movie.title, movie.description, movie.release_year, movie.duration, movie.rent_cost, category.name as category, language.name as language, store.name as store_name
                              FROM movie
                              INNER JOIN category ON movie.category_id=category.category_id
                              INNER JOIN store ON movie.store_id=store.store_id
                              INNER JOIN language ON movie.language_id=language.language_id
                              WHERE (title LIKE '%$search%' OR release_year LIKE '%$search%' OR category.name LIKE '%$search%' OR store.name LIKE '%$search%' OR rent_cost LIKE '%$search%' OR language.name LIKE '%$search%')");
      //$stmt->bindParam(':search', $search);
      $stmt->execute();

      // set the resulting array to associative
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $counter = $stmt->rowCount();
      //print_r($result);
      //print("\n");


      echo '<div class="jumbotron jumbotron-fluid">';
        if($result>0) {
          if($counter>0) { //count results
            echo '<p>' . $counter . ' result(s) found.</p>';
          }

          echo '<ul class="list-styled">';
          foreach ($result as $row) { //list results
            echo '<li><a href="../movie.php?q=' . $row['movie_id'] . '">' . $row['title'] . '</a></li>';
          }
          echo '</ul>';
        }

        if(empty($result)) {
          echo '<h1><b>Sorry, Not Result Found !</b></h1>';
        }
      echo '</div>';

      }
  catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
  $conn = null;

}
  ?>


</body>
</html>
