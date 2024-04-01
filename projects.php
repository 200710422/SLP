<?php
session_start();
//Header
include('includes/header.php');
include('includes/navbar.php');
include('config/dbcon.php');
?>
<link rel="stylesheet" href="assets/css/custom.css">
<style>
    .header {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 700;
        font-size: 48px;
        line-height: 58px;
        text-align: center;

        color: #283971;
        margin-top: 40px;
    }

    #main-image {
        margin-top: 10px;
    }

    #textfield {
        border: 4px solid #435283;
        border-radius: 15px;
        left: calc(50% - 798px/2 - 8px);
        width: 40%;
        margin-left: 20%;
        margin-top: 60px;
    }

    ::placeholder {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 500;
        font-size: 13px;
        line-height: 16px;
        letter-spacing: 0.205em;

        color: rgba(40, 57, 113, 0.47);
    }

    .filter {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 700;
        font-size: 12px;
        line-height: 15px;
        text-align: center;
        letter-spacing: 0.2em;

        color: #6F6F6F;
        margin-left: 100px;
    }

    .filter-type {
        background: #283971;
        border-radius: 30px;
        width: 157.07px;
        height: 38.96px;
        border: none;
        padding: 8px;
        color: #FFFFFF;
        font-weight: bold;
        border: none;
        text-decoration: none;
    }

    .horizontal-line {
        background-color: #283971;
        width: 50%;
        margin: auto;
        border-top: 4px solid #283971 !important;
        border-radius: 14px;
    }
</style>
<h4 class="header">Projects</h4>
<hr class="horizontal-line">
<input type="search" name="" id="textfield" placeholder="    Input search keywords...">
<span class="filter">Filter ↓</span>
<select name="" id="" class="filter-type">
    <option value="">Alphabetical</option>
    <option value="">Year</option>
    <option value="">Department</option>
</select>
<div class="container-fluid custombg-image-row " id="main-image">
    <div class="row gy-3" style="display: flex; justify-content: center;">
        <!-- Main Body -->
        <div class="col-3">
        </div>
        <div class="col-6">

        </div>
        <div class="col-3"></div>
        <div class="mainContent">
            <div class="row">
                <?php
                $query = "SELECT * FROM posts";
                $query_run = mysqli_query($con, $query);
                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $item) {
                ?>
                        <div class="col-md-3 mb-3 gy-3" style="display: flex; justify-content: center;">
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

                if (isset($_GET['school_year']) && isset($_GET['college_id']) && !isset($_GET['department_id'])) {
                    $query3 = "SELECT * FROM department where college_id = $_GET[college_id]";
                    $query3_run = mysqli_query($con, $query3);
                    if (mysqli_num_rows($query3_run) > 0) {
                        foreach ($query3_run as $item) {
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
                    foreach ($query1_run as $item) {
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
                if (isset($_GET['school_year']) && isset($_GET['college_id']) && isset($_GET['department_id'])) {
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
                                        <a href="project-details.php?id=<?= $item['id'] ?>">
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

