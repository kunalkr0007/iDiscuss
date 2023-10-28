<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>iDiscuss - Coding Forums</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">


</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <div class="container px-5 my-4 min-vh-100">
        <h1 class="py-3">Search results for "<em><?php echo $_GET['search']; ?></em>"</h1>

        <?php 
        $noResult = true;
        $query = $_GET['search'];
        $sql = "SELECT * FROM `threads` WHERE MATCH(`thread_title`,`thread_desc`) against ('$query')";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $url = "thread.php?threadid=".$thread_id;

            
            echo '<div class="result">
                    <h3><a class="text-dark" href="'.$url.'">'.$title.'</a></h3>
                    <p>'.$desc.'</p>
                </div>';
            }

            if($noResult){
                echo '<div class="jumbotron p-5  bg-dark-subtle">
                <p class="display-4">No Result Found!</p>
                <p class="lead">Suggestions: 
                <ul>
                    <li> Make sure all words are spelled correctly. </li>
                    <li> Try different keywords. </li>
                    <li> Try more general words. </li>
                </ul>
                
                </p>
            </div>';
               }
        
        ?>
        </div>




    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>