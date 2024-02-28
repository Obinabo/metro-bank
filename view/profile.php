<?php
    session_start();
    include_once "../config/dbconfig.php";
    include_once "../config/func.inc.php";
    if(isset($_SESSION['acct_id'])){
        $id = $_SESSION['acct_id'];
    }else{
        redirect('./login');
    }
    $title = 'Picture Upload | Metro Digital Bank';
    include "includes/header.php";
    $q = "SELECT * FROM account WHERE acct_id = ? LIMIT 1";
    $stmt = mysqli_prepare ($con, $q);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $r = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($r)){
        $old_pic = $row['pic'];
    }
    //$row['status'] === 'ACTIVE' ? redirect('./dashboard') : '';
            
    
?>
<section>
    <h3 class="align-center" data-aos="fade-up">Hello <?php echo $row['lname']; ?>, Upload your image</h3>
    <!-- <p class="align-center" data-aos="fade-up">Looking for a mortgage? Let our team of experts guide you. They’ll take the time to ask about your individual circumstances and give advice that’s tailored to you.

        Already have a Metro Bank mortgage? Check our latest mortgage rates to see all your rate switching options.
        <br/><br/>
        Having trouble paying your mortgage? Our mortgage payment support page tells you how we can help, and has information about The Mortgage Charter. Please do let us know sooner rather than later if you are struggling.
    </p> -->
    <div class="about-us">
        <div class="items" data-aos="fade-up">
            <img src="<?php echo $old_pic; ?>" alt="Profile pic"/>
            <div class="left">
            
                <h4>Select an image from your device to upload</h4>
                <p>Supported formats: JPG, JPEG, PNG.</p>
                <p>Maximum file size: 5MB</p>
                <!-- <a href="./login" class="align-center white blue-button">Residential mortgage range</a> -->
            </div>
            <!-- <img src="assets/img/house-blue.jpg" alt="Residential mortgages"> -->
        </div>
        <div class="items" data-aos="fade-up">
            <div class="left">
            <?php
                if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['submit']))){
                    $msg = array();
                    $max_size = 5 * 1024 * 1024;
                    if($_FILES['file']['size'] > $max_size){
                        $msg[] = '<div class="error">Choose an image that is less than 5MB</div>';
                    }else{
                        if(empty($_FILES['file']['name'])){
                            $msg[] = '<div class="error">Please select an image</div>';
                        }else{
                            $temp = $_FILES['file']['tmp_name'];
                            $upload_dir = "uploads/";
                            $file_name = basename($_FILES['file']['name']);
                            $file_ext = explode('.', $file_name);
                            $ext = strtolower(end($file_ext));
                            $allowed = array('jpeg','jpg','png');
                            if(!in_array($ext, $allowed)){
                                $msg[] = '<div class="error">Please select a PNG or JPG image</div>';
                            }else{
                                if(empty($msg)){ 
                                    if(uploadImage($con, $id, $upload_dir, $temp, $ext) === TRUE){
                                        $status = 'ACTIVE';
                                        $q = "UPDATE account SET status = ? WHERE acct_id = ?";
                                        $stmt = mysqli_prepare($con, $q);
                                        mysqli_stmt_bind_param($stmt, 'si', $status, $id);
                                        mysqli_stmt_execute($stmt);
                                        // redirect('./profile');
                                        echo '<div class="success">Image Uploaded</div>';
                                        echo '<button type="button" onclick="window.location.href = \'./dashboard\';" class="submit-blue2 align-center white" style="background: green;">Proceed to dashboard</button>';
                                    }else{
                                        $msg[] = '<div class="error">Failed to upload</div>';
                                    }
                                }else{
                                    echo implode('<br/>', $msg);
                                }
                            }
                        }
                    }
                }
            ?>
                <?php 
                    // if (!empty($msg)) {   
                        
                    // } 
                ?> 
                <form method="POST" action="./profile" enctype="multipart/form-data">
                <input type="file" name="file"/>
                <button type="submit" name="submit" class="submit-blue2 align-center white">Upload Image</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include "includes/footer2.php"; ?>