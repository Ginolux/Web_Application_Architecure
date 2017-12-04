<?php
// Start the session
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

  <?php
    include 'templates\head.php'
  ?>

  <body>

    <?php
      include 'templates\front_carousel.php'
    ?>

    <?php
      include 'templates\navigation.php'
    ?>

    <?php
      include 'templates\row_carousel_1.php'
    ?>

    <?php
      include 'templates\row_carousel_2.php'
    ?>

    <?php
      include 'templates\row_carousel_3.php'
    ?>

    <?php
      include 'templates\row_carousel_4.php'
    ?>

  </body>

  <?php
    include 'templates\footer.php'
  ?>

  <script>
      $('#scrollable_1').carousel({
        //pause: true,
        interval: false
      });

      $('#scrollable_2').carousel({
        //pause: true,
        interval: false
      });

      $('#scrollable_3').carousel({
        //pause: true,
        interval: false
      });
  </script>


</html>
