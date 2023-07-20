<?php
     //connect to the database
     
    $insert=false;
    $update=false;
    $delete=false;
    $servername="localhost";
     $username="root";
     $password="";
     $database="notes";
     
     //create a connection
     $conn=mysqli_connect($servername,$username,$password,$database);

     //Die if connections will not sucessful
     if (!$conn) {
      die("Connection not sucessful:".mysqli_connect_error());
     } 
    //  echo $_GET['update'];
    //  echo $_POST['srnoEdit'];
    //  exit();
 if(isset($_GET['delete'])){
  $srno= $_GET['delete'];
  // echo $srno;
  $delete=true;
 $sql="DELETE FROM `notes` WHERE `srno.` = $srno ";
 $result=mysqli_query($conn,$sql);
 }
 
     if($_SERVER['REQUEST_METHOD']=='POST')
        {
          if(isset($_POST['srnoEdit'])){
            //update the records
            $srnoEdit=$_POST["srnoEdit"];
            $title=$_POST["titleEdit"];
            $description=$_POST["descriptionEdit"];
    
             $sql="UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `srno.` = '$srnoEdit' ";
             $result=mysqli_query($conn,$sql);
             if ($result) {
              $update=true;
             }
             else{
              echo"We could not updated sucessfully";
             }
          }
          else{
            $title=$_POST["title"];
            $description=$_POST["description"];
    
             $sql="INSERT INTO `notes` ( `title`, `description`) VALUES ('$title','$description')";
             $result=mysqli_query($conn,$sql);
    
            if ($result) {
               $insert=true;
             }
            else {
              echo"Error occupie because of this--> ". mysqli_error($conn);
            }
          }
        
            
     }
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

  <!-- datatables search on google and include -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

  <!-- firstly insert jquery  -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

  <title>iNotes - Notes taking made easy</title>
</head>

<body>
  <!-- Button trigger modal
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit This Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/kashishphp/32CRUD Operations/index.php" method="post">
            <input type="hidden" name="srnoEdit" id="srnoEdit">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="description">Note Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>
            <!-- <button type="submit" class="btn btn-primary mb-4">Update Note</button> -->
        </div>
        <div class="modal-footer d-block">
        <button type="submit" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        </div>
        </form>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img src="/kashishphp/32CRUD Operations/phplogo.png" alt="" srcset="" height="30px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>\,

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <?php
   if($insert){
    echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success</strong> Your note has been inserted succesfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
   }

  ?>
  <?php
   if($update){
    echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success</strong> Your note has been updated succesfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
   }

  ?>
  <?php
   if($delete){
    echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success</strong> Your note has been deleted succesfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
   }

  ?>
  <div class="container mt-4">
    <h2>Add a Notes to iNotes</h2>
    <form action="/kashishphp/32CRUD Operations/index.php" method="post">
      <div class="form-group">
        <label for="title">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="description">Note Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary mb-4">Add Note</button>
    </form>
  </div>

  <div class="container">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">srno.</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
      $sql="SELECT * FROM `notes`";
      $result=mysqli_query($conn ,$sql);
      while ($row = mysqli_fetch_assoc($result)) {
        echo
        "<tr>
        <th scope='row'>" . $row['srno.']."</th>
        <td>". $row['title'] ."</td>
        <td>". $row['description']."</td>
        <td><button class='edit btn btn-sm btn-primary' id=".$row['srno.'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['srno.'].">Delete</button></td>
        </tr>";
          // echo $row['srno.']. " Title is " . $row['title'] ." Desc is ". $row['description'] ;
          // echo "<br>";
      }
    ?>
      </tbody>
    </table>
  </div>
  <hr>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>

  <!-- datatables link -->
  <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("Edit ",);
        // console.log("edit ",e.target.parentNode.parentNode);
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        srnoEdit.value = e.target.id;
        console.log(e.target.id);
        titleEdit.value = title;
        descriptionEdit.value = description;
        $('#exampleModal').modal('toggle');

      })
    })
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("Delete ",);
        srno = e.target.id.substr(1,);
        if (confirm("Are you sure you want to delete this note!")) {
          console.log("Yes");
          window.location = `/kashishphp/32CRUD Operations/index.php?delete=${srno}`;
          //create a form and use post request to submit a form
        }
        else {
          console.log("No");
        }

      })
    })
  </script>

</body>

</html>