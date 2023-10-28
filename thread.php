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

    a {
        text-decoration: none;
    }
    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <?php

    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE `thread_id`= $id";
    $result = mysqli_query($conn, $sql);

   while($row = mysqli_fetch_assoc($result)){
    $title = $row['thread_title'];
    $desc = $row['thread_desc'];
    $thread_user_id = $row['thread_user_id'];

    // To find out the name of comment
    $sql2 = "SELECT `user_email` FROM `users` WHERE `sno`= '$thread_user_id'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $posted_by = $row2['user_email'];
   
} 
    ?>

    <?php 
    $showAlert = false;

    $method = $_SERVER['REQUEST_METHOD'];
    if ($method== 'POST'){
        // Insert into comment  db
        $comment = $_POST['comment'];
        $comment = str_replace("<","&lt",$comment);
        $comment = str_replace(">","&gt",$comment);
        $sno = $_POST['sno'];

        $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your comment has been submitted successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }

?>

    <div class="container px-5 my-4 ">

        <div class="jumbotron p-5  bg-dark-subtle">
            <h2 class="display-5"> <?php echo $title  ?></h2>
            <p class="lead"><?php echo $desc  ?> </p>
            <hr class="my-4">
            <p>This is a peer to peer platform for sharing knowledge with each other
                Warn About Adult Content. Do not spam. Do Not Bump Posts. Do Not Offer to Pay for Help. Do Not Offer to
                Work For Hire. Do Not Post About Commercial Products. Do Not Create Multiple Accounts (Sockpuppets) When
                creating links to other resources.
            </p>
            <p class=" fw-bold">
                Posted By: <a href="" class=" link-primary"><?php echo $posted_by ?>  </a>
            </p>
        </div>

    </div>
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo '<div class="container px-5 my-4">
        <h2 class="py-2">Post a comment</h2>
        <form action="'. $_SERVER['REQUEST_URI'].'" method="post">
            <div class="mb-3">
                <label for="desc">Type your comment</label>
                <textarea class="form-control" id="comment" name="comment" style="height: 100px"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">

            </div>
            <button type="submit" name="submit" class="btn btn-success">Post Comment</button>
        </form>
    </div>';
    }
    else
    {
        echo '<div class="px-5 container">
        <h2 class="py-2">Post a comment</h2>
        <p class="lead">You are not logged in. Please login to be able to comment. </p>
        </div>';
    }
    ?>

    <div class="container px-5 mb-5" id="ques">
    <h2 class="py-2">Discussions</h2>
        <?php

        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE `thread_id`= $id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;

        while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $id = $row['comment_id'];
        $content = $row['comment_content'];
        $comment_time = $row['comment_time'];
        $thread_user_id = $row['comment_by'];

        $sql2 = "SELECT `user_email` FROM `users` WHERE `sno`= '$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
    

      echo '<div class="d-flex my-3">
            <div class="flex-shrink-0">
                <img src="img/userdefault.png" width="50px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
            <p class="fw-bold my-0 ">'.$row2['user_email'].' at '.$comment_time.' </p>
                '.$content.'
            </div>
        </div>';

       } 
       if($noResult){
        echo '<div class="jumbotron p-5  bg-dark-subtle">
        <p class="display-4">No Comments Found!</p>
        <p class="lead">Be the first person to answer this thread.</p>
    </div>';
       }
    ?>

    </div>


    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>