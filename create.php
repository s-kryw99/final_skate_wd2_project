<?php
/*
 * Name:Alex Fleming
 * Title: create.php
 * Description: This file has the code needed for using the "New Entry" part of the website to
 * make new posts to skateboard database.
 *
 */

 require 'header.php';


$error = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_STRING);

if(isset($_FILES['image']) && $_FILES['image']['error'] === 0)
{
  function file_is_an_validate($temporary_path, $new_path)
  {
    $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];
    $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];

    $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
    $aparent_mime_type       = $_FILES['image']['type'];


    $actual_mime_type        = getimagesize($temporary_path)['mime'];

    $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
    $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);

    return $file_extension_is_valid && $mime_type_is_valid;
  }

//gets the pieces of the file name and put it togeather with backslashes
function file_upload_path($original_filename, $upload_subfolder_name = 'uploads')
{
      //"in this house we call that original file name"
      $current_folder = dirname(__FILE__);
      $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
      return join(DIRECTORY_SEPARATOR, $path_segments);
    }

    $image_filename       = $_FILES['image']['name'];
    $temporary_image_path = $_FILES['image']['tmp_name'];
    $new_image_path       = file_upload_path($image_filename);
      $img="uploads/".$image_filename;
      echo '<img src= "'.$img.'">';




      $source = $img;   #brad.jpg  ... brad_540-400.jpg
      $dest = "uploads/res_".$_FILES['image']['name'];

      $size = getimagesize($source);
      $width = $size[0];
      $height = $size[1];

      $resize = "0.5";
      $rwidth = ceil($width * $resize);
      $rheight = ceil($height * $resize);
      //
      // $original = imagecreatefromjpeg($source);
      //
      // $resized = imagecreatetruecolor($rwidth, $rheight);
      // imagecopyresampled(
      //   $resized, $original,
      //   0,0,0,0,
      //   $rwidth, $rheight,
      //   $width, $height
      // );
      //
      // imagejpeg($resized, $dest);
      // echo "OK";



            // if($_FILES['image']['type'])
            // {
                  $original = imagecreatefromjpeg($source);
            // }
            //
            // elseif($_FILES['image']['gif'])
            // {
            //       $original = imagecreatefromgif($source);
            // }
            //
            // elseif($_FILES['image']['png'])
            // {
            //     $original = imagecreatefrompng($source);
            // }


            $resized = imagecreatetruecolor($rwidth, $rheight);
            imagecopyresampled(
              $resized, $original,
              0,0,0,0,
              $rwidth, $rheight,
              $width, $height
            );

      //
      // if($_FILES['image']['jpeg'])
      // {
            imagejpeg($resized, $dest);
            echo "OK";
      // }
      //
      // elseif($_FILES['image']['gif'])
      // {
      //       imagegif($resized, $dest);
      //       echo "OK";
      // }
      //
      // elseif($_FILES['image']['png'])
      // {
      //     imagepng($resized, $dest);
      //     echo "OK";
      // }





// var_dump($source);
// echo "<br>";
// var_dump($width, $height);
// echo "<br>";
// var_dump($newwidth);
// echo "<br>";
// var_dump($newheight);
// echo "<br>";
// var_dump($destination);
// echo "<br>";
// var_dump(imagecopyresampled($destination, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height));
// echo "<br>";
// var_dump(imagejpeg($destination, $image_filename, 100));
// echo "<br>";






    if(file_is_an_validate($temporary_image_path, $new_image_path))
    {
      echo ((move_uploaded_file($temporary_image_path, $new_image_path))?("Success"):("Failed"));
    }
  }
?>


<!-- header.php starts here -->
<!-- image upload  -->
    <?php if (!isset($_FILES['image'])) : ?>

      <form method="post" enctype="multipart/form-data">
      <label hidden for="image">Image Filename:</label>
        <input type="file" name="image" id="image">
        <input type="submit" name="submit" value="Upload Image">
      </form>

    <?php elseif (isset($_FILES['image']) && $_FILES['image']['error'] > 0): ?>

      <p>Error Number: <?= $_FILES['image']['error'] ?></p>

    <?php elseif (isset($_FILES['image'])): ?>

      <p>Client-Side Filename: <?= $_FILES['image']['name'] ?></p>
      <p>Apparent Mime Type:   <?= $_FILES['image']['type'] ?></p>
      <p>Size in Bytes:        <?= $_FILES['image']['size'] ?></p>
      <p>Temporary Path:       <?= $_FILES['image']['tmp_name'] ?></p>
    <?php endif ?>
    <div class="container" style="width:500px;">

<?php if (isset($error)) { ?>
  <div id="error_message">
    <p><?= $error ?></p>
  </div>
<?php } ?>


      <div class="container" style="width:500px;">
      <form action="process_post.php" method="post">
        <fieldset>
          <legend>New Deck Entry Form</legend>
          <p>
            <label for="title">Title</label>
            <input name="title" id="title" />
          </p>
          <p>
            <label for="brand">Brand</label>
            <input name="brand" id="brand" />
          </p>
          <p>
            <label for="length">Length (in cm)</label>
            <input name="length" id="length" />
          </p>
          <p>
            <label for="width">Width (in cm)</label>
            <input name="width" id="width" />
          </p>
          <p>
            <label for="release_year">Release Year</label>
            <input name="release_year" id="release_year" />
          </p>
          <p>
            <label for="year_used">Year of Use</label>
            <input name="year_used" id="year_used" />
          </p>
          <p>
            <label for="rating">Rating</label>
            <input name="rating" id="rating" />
          </p>
          <!-- //echo image id request into hiddem input. -->
          <p>
           <label hidden>img filename</label>
           <input type="hidden" name="sp_image" value="<?php echo htmlspecialchars($image_filename);?>" />
           </p>
          <p>
            <label for="notes">Notes</label>
            <textarea name="notes" id="notes"></textarea>
          </p>
          <p>
            <input class ="btn" type="submit" name="command" value="Create" />
          </p>
        </fieldset>
      </form>
  <div>

      <!-- Footer inserted here -->
      <br /><br />
      <?php  require 'footer.php'; ?>
