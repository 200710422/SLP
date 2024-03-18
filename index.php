<?php
session_start();
//Header
include('includes/header.php');
include('includes/navbar.php');
include('config/dbcon.php');
?>
<link rel="stylesheet" href="assets/css/custom.css">
<body>
    
<div class="card bg-transparent border-0 headImage">
  <img src="assets/images/images.jpg" class="card-img headPic" alt="...">
  <div class="card-img-overlay">
    <h5 class="card-title" style="color: white;">About Us</h5>
    <p class="card-text">Lorem Ipsum   </p>
    
  </div>
</div>
    <div class="container-fluid custombg-image-row ">
        <div class="row gy-3">
            <!-- Main Body -->
            <div class="mainContent">
                    <div class="row gy-3">
                    <div class="articles">ARTICLES</div>
                        <?php
                        
                        $query = "SELECT * FROM students";
                        $query_run = mysqli_query($con, $query);
                        if(mysqli_num_rows($query_run) > 0)
                        {
                            foreach($query_run as $item)
                            {
                            ?>
                            <div class="col-md-4 mb-4 gy-4">
                            <div class="card bg-transparent border-0 p-3 FmarginCard">
                                <img src="assets/images/images.jpg" class="card-img articleImage" alt="...">
                                <div class="card-img-overlay">
                                   
                                </div>
                                </div>
                                  
                            </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                    
                    
                    
                </div>
                
                <div class="secondContent" >
                    
                    <div class="row gy-3">
                    <div class="projects">PROJECTS</div>
                        <?php
                        
                        $query = "SELECT * FROM students";
                        $query_run = mysqli_query($con, $query);
                        if(mysqli_num_rows($query_run) > 0)
                        {
                            foreach($query_run as $item)
                            {
                            ?>
                            <div class="col-md-4 mb-4 gy-4">
                            <div class="card bg-transparent border-0 p-3 marginCard">
                                <img src="assets/images/images.jpg" class="card-img articleImage" alt="...">
                                <div class="card-img-overlay">
                                   
                                </div>
                                </div>
                                  
                            </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                  
                    
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<!-- Footer -->
<?php include('includes/footer.php'); ?>
