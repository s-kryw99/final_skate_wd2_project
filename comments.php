<?php
/*
 * Name:Alex Fleming
 * Title: create.php
 * Description: This file has the code needed for using the "New Entry" part of the website to
 * make new posts to skateboard database.
 *
 */

 // require 'header.php';

?>


<!-- header.php starts here -->
<!-- image upload  -->

    <div class="container" style="width:500px;">
      <div class="container" style="width:500px;">
      <form action="process_post.php" method="post">
        <fieldset>
          <legend>User Comment</legend>
          <p>
            <label for="name">Name</label>
            <input name="name" id="name" />
          </p>
            <label for="comments">Notes</label>
            <textarea name="comments" id="comments"></textarea>
          </p>
          <p>
            <input class ="btn" type="submit" name="command" value="Create" />
          </p>
        </fieldset>
      </form>
  <div>
