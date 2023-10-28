<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>iDiscuss - Coding Forums</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    #ques {
        min-height: 500px;
    }
    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <?php

    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE `category_id`= $id";
    $result = mysqli_query($conn, $sql);

   while($row = mysqli_fetch_assoc($result)){
    $catname = $row['category_name'];
    $catdesc = $row['category_description'];
} 
    ?>

    <?php 
    $showAlert = false;

    $method = $_SERVER['REQUEST_METHOD'];
    if ($method== 'POST'){
        // Insert into thread db
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];

        $th_title = str_replace("<","&lt",$th_title);
        $th_title = str_replace(">","&gt",$th_title);

        $th_desc = str_replace("<","&lt",$th_desc);
        $th_desc = str_replace(">","&gt",$th_desc);

        // $th_title = $_POST['title'];
        $sno = $_POST['sno'];

        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been submitted successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }

    ?>

    <div class="container px-5 my-4 ">

        <div class="jumbotron p-5  bg-dark-subtle">
            <h2 class="display-5">Welcome to <?php echo $catname  ?> Forum</h2>
            <p class="lead"><?php echo $catdesc  ?> </p>
            <hr class="my-4">
            <p>This is a peer to peer platform for sharing knowledge with each other
                Warn About Adult Content. Do not spam. Do Not Bump Posts. Do Not Offer to Pay for Help. Do Not Offer to
                Work For Hire. Do Not Post About Commercial Products. Do Not Create Multiple Accounts (Sockpuppets) When
                creating links to other resources.
            </p>
            <p class="lead">
                <a class="btn btn-success " href="#" role="button">Learn more</a>
            </p>
        </div>

    </div>
    <?php 

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  echo  '<div class="container px-5 my-4">
        <h2 class="py-2">Start a Discussion</h2>
           <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
                <div class="mb-3 mt-2">
                    <label for="title" class="form-label">Problem Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="title">
                    <div id="title" class="form-text">Keep your title as short as possible.</div>
                </div>

                <div class="mb-3">
                    <label for="desc">Elaborate your concern</label>
                    <textarea class="form-control" id="desc" name="desc" style="height: 100px"></textarea>
                    <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">

                </div>
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
            </form>
            </div>';
        }
      
    else
        {
            echo '<div class="px-5 container">
            <h2 class="py-2">Start a Discussion</h2>
            <p class="lead">You are not logged in. Please login to be able to start a discussion. </p>
            </div>';
        }
    
        ?>
   

    <div class="container px-5 mb-5" id="ques">
        <h2 class="py-2">Browse Questions</h2>

        <?php

        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE `thread_cat_id`= $id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;

        while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_time = $row['timestamp'];
        $thread_user_id = $row['thread_user_id'];

        $sql2 = "SELECT `user_email` FROM `users` WHERE `sno`= '$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
       

    

      echo '<div class="d-flex my-3 ">
            <div class="flex-shrink-0">
                <img src="img/userdefault.png" width="50px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
                 <p class="fw-bold my-0 ">'. $row2['user_email']. ' at '.$thread_time.' </p>
                <h5 class="mt-0"><a class="link-underline link-underline-opacity-0 link-underline-opacity-75-hover link-dark " href="thread.php?threadid='.$id.'" >'.$title.'</a></h5>
                
                '.$desc.'
            </div>
        </div>';
       } 

       if($noResult){
        echo '<div class="jumbotron p-5  bg-dark-subtle">
        <p class="display-4">No Threads Found!</p>
        <p class="lead">Be the first person to ask a question.</p>
    </div>';
       }

    ?>

    </div>


    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>