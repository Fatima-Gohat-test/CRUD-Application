<!-- Database connection -->
<?php
$insert=false;
$update=false;
$delete=false;

$servername="localhost";
$username="root";
$password="";
$database="todoapp";
// create connection 
$conn= mysqli_Connect($servername,$username,$password,$database);

// Die if connection was not successful
if (!$conn){
  die("Sorry we failed to connect: ". mysqli_connect_error());
}

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `notes`.`Sno` = $sno";
  $result = mysqli_query($conn, $sql);
  if($result){
    echo "delete";
    
  }
  else{
    echo "due to this ".mysqli_error($conn);
  }
}


//For create 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if(isset($_POST['snoEdit'])){
  //UPDATE THE RECCORD
  $sno=$_POST['snoEdit'];
  $title= $_POST["titleedit"];
  $descrption= $_POST["descrptionedit"];

//sql querry which is executed

$sql = "UPDATE `notes` SET `title` = '$title', `descrption` = '$descrption' WHERE `notes`.`Sno` =$sno";
$result = mysqli_query($conn, $sql);

if($result){
  $update=true;
}
else{
  echo "not update";
}

}
else
{
  $title= $_POST["title"];
  $descrption= $_POST["descrption"];

//sql querry which is executed
$sql = "INSERT INTO `notes`(`title`, `descrption`) 
VALUES ('$title','$descrption')";
$result = mysqli_query($conn,$sql);

//FOR CHECK DATA INSERTION
if($result){
    // echo "Data has been inserted successfully";
    $insert=true;
}
else{
    echo "Data has not been inserted successfully".mysqli_error($conn);
}
}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>iNote</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

  </head>
  <body>
  
  <!-- Edit modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModallLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit this Note</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      

 <!-- form -->
 <div class="container my-5">
      <form action="/tutorial/31-CRUD-operation.php" method="POST">
        <input type="hidden" name="snoEdit" id="snoEdit">
        <div class="mb-3">
          <label for="title" class="form-label"
            >Notes Title</label
          >
          <input
            type="text"
            class="form-control"
            id="titleedit"
            name="titleedit"
            aria-describedby="emailHelp"
          />
         
        </div>
        
        <div class="form-floating mb-3">
      

  <textarea class="form-control" placeholder="Leave a comment here" id="descrptionedit" 
  name="descrptionedit" style="height: 100px"></textarea>
  <label for="descrption">Notes Description here..</label>
</div>
        
        <button type="submit" class="btn btn-primary">Update Notes</button>
      </form>
    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">iNote</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact-Us</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>

    
<!-- ALERT-FOR-INSERTION-SUCCESSFULLY -->
<?php
if ($insert)
 {
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success</strong> Reccord has been inserted Successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}

if ($update) 
{
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success</strong> Reccord has been Updated Successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
if ($delete)
 {
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success</strong> Reccord has been Deleted Successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
?>

    <!-- form -->
    <div class="container my-5">
      <form action="/tutorial/31-CRUD-operation.php" method="POST">
        <div class="mb-3">
          <label for="title" class="form-label"
            >Notes Title</label
          >
          <input
            type="text"
            class="form-control"
            id="title"
            name="title"
            aria-describedby="emailHelp"
          />
         
        </div>
        
        <div class="form-floating mb-3">
      

  <textarea class="form-control" placeholder="Leave a comment here" id="descrption" 
  name="descrption" style="height: 100px"></textarea>
  <label for="descrption">Notes Description here..</label>
</div>
        
        <button type="submit" class="btn btn-primary">Add Notes</button>
      </form>
    </div>

<!-- Table -->
<div class="container">
 
<table class="table"  id="myTable" >
  <thead>
    <tr>
      <th scope="col">S.NO</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  
  
  <?php
 $sql= "SELECT * FROM `notes`";
 $result = mysqli_query($conn, $sql);
 $sno = 0;

 while($row=mysqli_fetch_assoc($result)){
   $sno = $sno + 1;
  echo "<tr>
  <th scope='row'>" . $sno . "</th>
  <td>".$row['title']."</td>
  <td>".$row['descrption']."</td>
  <td>   
  <button class='edit btn btn-sm btn-primary' id=".$row['Sno'].">Edit</button>
  <button class='delete  btn btn-sm btn-primary' id=".$row['Sno'].">Delete</button>
  </td>
     </tr>";
    
 }
  ?> 
   </tbody>
</table>
</div>

    <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>

    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
//FOR EDIT
    // edit is the classname of a button

      edits=document.getElementsByClassName('edit');
      Array.from(edits).forEach((element)=>{
        // here add click event listener so when click on button of edit
        element.addEventListener("click",(e)=>{
          console.log("edit ",);
          //Parent node means that button and its parrent
          tr = e.target.parentNode.parentNode;
          title=tr.getElementsByTagName("td")[0].innerText;
          desc=tr.getElementsByTagName("td")[1].innerText;
          console.log(title,desc);
           descrptionedit.value=desc;
         titleedit.value=title;
        //  e.target means button
         snoEdit.value=e.target.id;
         console.log(e.target.id);
    // modal toogle through js
     $('#editModal').modal('toggle');
        })
      })


//for delete 
deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("delete ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/tutorial/31-CRUD-operation.php?delete = ${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>

  </body>
</html>
