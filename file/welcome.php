<?php 
// Script 9.7 - welcome.php #2
/* This is the welcome page. The user is redirected here
after they successfully log in. */

// Need the session:
session_start();

if (isset($_SESSION['username'])) {
  // Set the page title and include the header file:
  echo "<title>Welcome</title>";
  //include('templates/header.html'); 
  // Print a greeting:
  print '<h2>Welcome to CS262 Web development!</h2>';
  print '<p>Hello, ' . $_SESSION['username'] . '!</p>';
  date_default_timezone_set('Asia/Phnom_Penh');
  print '<p>You have been logged in since: ' . $_SESSION['loggedin'] . '.</p>';
  ?>
  <form action="welcome.php" id="submissionForm" enctype="multipart/form-data" method="post">
    <input type="file" class="file" name="files" accept="application/pdf"><br>
    <button type="submit">Submit</button>
  </form>
  <button onclick="addInput()">Add</button>
  <?php
  // Make a logout link:
  print '<p><a href="logout.php">Logout</a></p>';
  session_reset();
  // session_unset();
} else {
  echo 'You need to log in first <br>
    <a href="login.php">Login </a> ';
}

//include('templates/footer.html'); // Need the footer.
?>
<?php
  
  if(isset($_FILES['files'])){
    $name_file=$_FILES['files']['name'];
    $tmp_name=$_FILES['files']['tmp_name'];
    $local = "uploaded/";
    move_uploaded_file($tmp_name,$local.$name_file);
  }
  
?>
<script>
function addInput() {
  const form = document.querySelector('#submissionForm');
  form.insertAdjacentHTML('afterbegin', "<input type=\"file\" class=\"file\" name=\"files\" accept=\"application/pdf\"><br>");
}
</script>