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
            <p><span class="bold-amount">Total Transfers</span></p>
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
     
        $qTrans .= " ORDER BY date DESC LIMIT $limit OFFSET $offset";
        $stmtTrans = mysqli_prepare($con, $qTrans);
        // mysqli_stmt_bind_param($stmtStat, 's', $pend);
        mysqli_stmt_execute($stmtTrans);
        $result = mysqli_stmt_get_result($stmtTrans);
        
        $numRows = mysqli_num_rows($result);
        
        if($numRows > 0){
            echo'
                <div class="table-container">
                    <table>
                        <tr>
                            <th>S/N</th>
                            <th>Beneficiary Account</th>
                            <th>Beneficiary Name</th>
                            <th>Bank</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Trx ID</th>
                            <th>Date</th>
                        </tr>';
                        $sn = 1;
                        while($row2 = mysqli_fetch_array($result)){
                            echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$row2['acct_number'].'</td>
                                <td>'.$row2['acct_name'].'</td>
                                <td>'.$row2['bank'].'</td>
                                <td>'.$row2['amount'].'</td>
                                <td>'.$row2['type'].'</td>
                                <td>'.$row2['status'].'</td>
                                <td>'.$row2['trx_id'].'</td>
                                <td>'.$row2['date'].'</td>
                                </tr>
                                ';
                            $sn++;
                        }
                    echo '</table>
                    </div>';
            $totalPages = ceil($transNumRows / $limit);
            echo '<p style="border: none; text-align: center;">Page ';
                    for($i = 1; $i <= $totalPages; $i++){
                        echo '<a href="?page=' . $i . '">' . $i . '  </a>';
                    }
            echo '</p>';
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
