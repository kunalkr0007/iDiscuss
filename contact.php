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

    <div class="container my-3 w-50 min-vh-100">
      <h2 class="my-3 text-center">Contact Us</h2>

      <div class="mb-4">
          <label for="exampleFormControlName" class="form-label">Name</label>
          <input type="text" class="form-control" id="exampleFormControlName">
      </div>
        <div class="mb-4">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        
        <div class="mb-4">
            <label for="exampleFormControlTextarea1" class="form-label"> Your Concern</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>

        <button class="btn btn-success">Submit</button>


    </div>



    <?php include 'partials/_footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>