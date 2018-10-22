<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1" charset="utf-8">

<style>
  body {font-family: Arial, Helvetica, sans-serif;}
  th,td{
    border-bottom:1px solid #ddd;
    text-align: left;
    padding: 8px;
  }
  tr:hover {background-color:#f5f5f5;}

    /* The Modal (background) */
  .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }

  /* Modal Content */
  .modal-content {
      background-color: #fefefe;
      margin: auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
  }

  /* The Close Button */
  .close {
      color: #aaaaaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
  }

  .close:hover,
  .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
  }

</style>
</head>

<body>

<div style="overflow-x:auto;">
  <table id="dbTable">
    <tr>
      <th>Item</th><th>Building</th><th>Room</th><th>Room Location</th>
    </tr>
    <?php
      include 'hidden.php';

      $rowNum = 1;
      $conn = new mysqli($servername, $username, $password,$dbName);

      if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT * FROM inventory.MCSI";
      $result = mysqli_query($conn,$sql);

      if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($result)) {
              echo "<tr id='$rowNum'".' onclick="delete()" ><td>'.$row["Item"]."</td><td>".$row["Building"]."</td><td>". $row["Room"]."</td><td>". $row["Room Location"]."</td></tr>";
              $rowNum = $rowNum + 1;
          }
      } else {
          echo "0 results";
      }

      $rowNum=0;
      mysqli_close($conn);

     ?>
  </table>
</div>

<!-- <script>
  function delete(){
    window.alert("progress!");
  }
</script> -->


<!-- Trigger/Open The Modal -->
<button id="myBtn">Open Modal</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    Item:<br>
    <input type = "text" id="itemDB" name = "Item" value="itemDB"><br>
    Building:<br>
    <input type = "text" id="bldDB" name = "Building" value="bldDB"><br>
    Room:<br>
    <input type = "text" id="rmDB" name = "Room" value="rmDB"><br>
    Room_Location:<br>
    <input type = "text" id="roomLocDB" name = "Room Location" value="roomLocDB" placeholder="ddd">
    <button onclick="addFunc()">Add Item</button>

  </div>

</div>


<script>
  // Get the modal
  var modal = document.getElementById('myModal');

  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks the button, open the modal
  btn.onclick = function() {
    modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
  }



  function addFunc(){

    modal.style.display = "none"
    var itemDB = document.getElementById("itemDB").value;
    var bldDB = document.getElementById("bldDB").value;
    var rmDB = document.getElementById("rmDB").value;
    var roomLocDB = document.getElementById("roomLocDB").value;


    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","addItems.php?q="+itemDB+"~"+bldDB+"~"+rmDB+"~"+roomLocDB,true);
    xmlhttp.send();

  }


</script>


</body>
</html>
