<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>iDiscuss - Coding Forums</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #ques{
            min-height:500px;
        }
     
    </style>

</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <!-- Slider start here -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img\slider-2.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img\slider-3.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <!-- <img src="https://source.unsplash.com/2400x650/?programmer,coding" class="d-block w-100" alt="..."> -->
                <img src="img\slider-1.jpeg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Category container start here -->

    <div class="container my-3" id="ques">
        <h3 class="text-center mt-2 mb-4">iDiscuss - Browse Categories</h3>

        <div class="row">

            <!-- Fetch all the categories and Use a loop to iterate through categories  -->

            <?php 
             $sql = "SELECT * FROM `categories`";
             $result = mysqli_query($conn, $sql);

             while($row = mysqli_fetch_assoc($result)){
              $id = $row['category_id'];
              $cat = $row['category_name'];
              $desc = $row['category_description'];
            //  echo $row['category_id']." ".$row['category_name']." ". $row['category_description']."<br>";
            // <img src="https://source.unsplash.com/500x350/?'.$cat.',coding" class="card-img-top" alt="..."> 
            // <a href="threadlist.php?catid='.$id.'"><img src="img/card-'.$id.'.jpeg" class="card-img-top" alt="..."></a>

           echo  '<div class="col-md-4 my-2">
                      <div class="card" style="width: 18rem;">
                         
                        <img src="img/card-'.$id.'.jpeg" class="card-img-top" alt="...">
                          <div class="card-body">
                              <h5 class="card-title"><a class=" link-underline link-underline-opacity-0 link-underline-opacity-75-hover  link-secondary" href="threadlist.php?catid='.$id.'">'.$cat.'</a></h5>
                              <p class="card-text">'.substr($desc, 0, 90).'...</p>
                              <a href="threadlist.php?catid='.$id.'" class="btn btn-sm btn-success ">View Threads</a>
                          </div>
                      </div>
                  </div>';
             }
             ?>
        </div>
    </div>


    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>