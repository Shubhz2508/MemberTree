<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Members Tree</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
/* CSS for the tree structure */
.tree {
  list-style-type: none;
}

.tree ul {
  margin-left: 20px;
}

.tree li {
  margin-top: 10px;
}

.tree li:before {
  content: "•";
  margin-right: 5px;
}
</style>
</head>
<body>

<h1>Members Tree</h1>

<ul class="tree">
  <!-- PHP code to dynamically generate the tree structure -->
  <?php
  // Database connection details
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "testdb";
  $port = 3306;

  // Create connection
  $conn = new mysqli($servername, $username, $password, $database, $port);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Query to retrieve members data
  $sql = "SELECT Id, Name, ParentId FROM members1";
  $result = $conn->query($sql);

  // Function to recursively generate the tree structure
  function generateTree($parentId, $members) {
    foreach ($members as $member) {
        if ($member['ParentId'] == $parentId) {
            echo "<li>";
            echo $member['Name'];
            echo "<ul>";
            generateTree($member['Id'], $members);
            echo "</ul>";
            echo "</li>";
        }
    }
}

  // Associative array to store members data
  $members = array();

  // Fetch members data from the database
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $members[$row['Id']] = $row;
      }
  }

  // Call the function to generate the tree structure starting from the root
  generateTree(NULL, $members);

  // Close connection
  $conn->close();
  ?>
</ul>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMemberModal">
  Add Member
</button>

<!-- Add Member Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addMemberModalLabel">Add Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addMemberForm">
          <div class="form-group">
            <label for="parent">Parent:</label>
            <select class="form-control" id="parent" name="parent">
              <!-- PHP code to dynamically generate the dropdown options with member names -->
              <?php
              // Database connection details
              $servername = "localhost";
              $username = "root";
              $password = "";
              $database = "testdb";
              $port = 3306;

              // Create connection
              $conn = new mysqli($servername, $username, $password, $database, $port);

              // Check connection
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }

              // Fetch all members from the database table
              $sql = "SELECT Id, Name FROM members1"; // <-- Corrected table name
              $result = $conn->query($sql);

              // Check if there are any members
              if ($result->num_rows > 0) {
                  // Output options for each member
                  while ($row = $result->fetch_assoc()) {
                      echo "<option value='" . $row['Id'] . "'>" . $row['Name'] . "</option>";
                  }
              } else {
                  echo "<option value='' disabled>No members found</option>";
              }

              // Close connection
              $conn->close();
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <button type="button" class="btn btn-primary" id="saveChangesBtn">Save Changes</button>        </form>
      </div>
    </div>
  </div>
</div>



<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="validation.js"></script>
<script src="saveData.js"></script>
<script>
jQuery.noConflict();
</script>
</body>
</html>
