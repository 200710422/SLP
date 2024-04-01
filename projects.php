<?php
session_start();
//Header
include('includes/header.php');
include('includes/navbar.php');
include('config/dbcon.php');
?>
<link rel="stylesheet" href="assets/css/custom.css">
<body>
    <div class="container-fluid custombg-image-row ">
        <div class="row gy-3">
        <h1 class="articlePage">Projects</h1>
        <div class="articleLine"></div>
            <!-- Main Body -->
            
            <div class="">
                    <div class="row">
                        <?php
                        $query = "SELECT * FROM posts";
                        $query_run = mysqli_query($con, $query);
                        if(mysqli_num_rows($query_run) > 0)
                        {
                            foreach($query_run as $item)
                            {
                            ?>
                            <div class="col-md-4 mb-3 gy-3" style="display: flex; justify-content: center;">
                                <div class="card h-100" style="width: 20rem; margin-left: 2vw;">
                                <a href="#"><img src="assets/images/vccineCrd.jpg" class="customPic"></a> <!-- Placeholder for image-->
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $item['id']; ?></h5>
                                        <p class="card-text"><?= $item['name']; ?></p>
                                        <!-- You can add more project details here -->
                                    </div>
                                </div> 
                            </div>
                            
                            <?php
                            }
                        }
                            //if School Year And College is Set as params render Departments
                            
                            if(isset($_GET['school_year']) && isset($_GET['college_id']) && !isset($_GET['department_id'])) {
                                $query3 = "SELECT * FROM department where college_id = $_GET[college_id]";
                                $query3_run = mysqli_query($con, $query3);
                                if (mysqli_num_rows($query3_run) > 0){
                                foreach($query3_run as $item) {
                                    ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <?php
                                                $department = $item['id'];
                                                $url = $base_url . "college_id=" . urlencode($_GET['college_id']) . "&department_id=" . urlencode($department);
                                                ?>
                                                <a href="<?= $url ?>">
                                                    <h5 class="card-title"><?= $item['name']; ?></h5>
                                                    <p class="card-text"><?= $department; ?></p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                            //If school year is Not set render School Years to be placed as params
                            elseif (!isset($_GET['school_year']) && !isset($_GET['college_id']) && !isset($_GET['department_id'])) {
                                foreach($query3_run as $item) {
                                    ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <?php
                                                $school_year = $item['id'];
                                                $url = $base_url . "school_year=" . urlencode($school_year);
                                                ?>
                                                <a href="<?= $url ?>">
                                                    <h5 class="card-title"><?= $item['school_year']; ?></h5>
                                                    <p class="card-text"><?= $school_year; ?></p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            //If SY, COLLEGE, DEPARTMENT SET, SHOW PROJECTS THAT USE THE PARAMS ELSE NO RECORDS
                            if(isset($_GET['school_year']) && isset($_GET['college_id']) && isset($_GET['department_id'])){
                                $query4 = "SELECT * FROM projects where school_year_id = $_GET[school_year] AND college_id = $_GET[college_id] AND department_id = $_GET[department_id]";
                                $query4_run = mysqli_query($con, $query4);
                    if (mysqli_num_rows($query4_run) > 0) {
                        foreach ($query4_run as $item) {
                        ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <?php
                                        $project = $item['id'];
                                        ?>
                                                <a href="project-details.php?id=<?=$item['id']?>">
                                                    <h5 class="card-title"><?= $item['name']; ?></h5>
                                                    <p class="card-text"><?= $project; ?></p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                            }
                    } else {
                        echo '<a style="color:white">No Records Found</a>';
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

<!-- Footer -->
<?php include('includes/footer.php'); ?>

