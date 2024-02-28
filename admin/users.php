<?php 
session_start();
include_once "../config/dbconfig.php";
include_once "../config/func.inc.php";
include_once "includes/count.inc.php";
    if(isset($_SESSION['id'])){
    //$id = $_SSESSION['id'];
    }else{
        redirect('index.php');
    }

    $title = 'Admin dashboard | '.SITE_NAME;
    include "includes/head.php"; 
?>

<div class="admin-section">
    <div class="balance" style="background: var(--dark-black);">
        <div class="left">
            <p><span class="bold-amount">Total Users</span></p>
            <p> </p>
        </div>
        <div class="right">
            <p></p>
        </div> 
    </div>

    <?php
        $limit = 10;
        $page = isset($_GET['page']) ? $_GET['page'] : 1; //current page number
        $offset = ($page - 1) * $limit; //calculate offset
     
        $qAccount .= " ORDER BY date DESC LIMIT $limit OFFSET $offset";
        $stmtAccount = mysqli_prepare($con, $qAccount);
        // mysqli_stmt_bind_param($stmtStat, 's', $pend);
        mysqli_stmt_execute($stmtAccount);
        $result = mysqli_stmt_get_result($stmtAccount);
        
        $numRows = mysqli_num_rows($result);
        
        if($numRows > 0){
            echo'
                <div class="table-container">
                    <table>
                        <tr>
                            <th>S/N</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Account No.</th>
                            <th>Email</th>
                            <th>Sex</th>
                            <th>Account Type</th>
                            <th>Available Balance</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>';
                        $sn = 1;
                        while($row2 = mysqli_fetch_array($result)){
                            echo '<tr>
                            <td>'.$sn.'</td>
                            <td>'.$row2['lname'].' '.$row2['fname'].'</td>
                            <td>'.$row2['uname'].'</td>
                            <td>'.$row2['acct_no'].'</td>
                            <td>'.$row2['email'].'</td>
                            <td>'.$row2['sex'].'</td>
                            <td>'.$row2['type'].'</td>
                            <td>'.$row2['a_bal'].'</td>
                            <td>'.$row2['status'].'</td>
                            <td>'.$row2['date'].'</td>
                                </tr>
                                ';
                            $sn++;
                        }
                    echo '</table>
                    </div>';
            $totalPages = ceil($accountNumRows / $limit);
            echo '<div class="history" style="border: none;">';
                    for($i = 1; $i <= $totalPages; $i++){
                        echo '<div class="right">Page <a href="?page=' . $i . '">' . $i . '</a></div>';
                    }
            echo '<div>';
        }else{
            echo '<div class="history">
                            <div class="left">
                                <h4>No Pending Account...</h4>
                            </div>
                        <div>';
        }
    ?>    

</div>


<?php include "includes/foot.php"; ?>
