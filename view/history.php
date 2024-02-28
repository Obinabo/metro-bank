<?php
    session_start();
    include_once "../config/dbconfig.php";
    include_once "../config/func.inc.php";
    if(isset($_SESSION['acct_id'])){
        $id = $_SESSION['acct_id'];
    }else{
        redirect('./login');
    }
    $title = 'History | '.SITE_NAME; 
    $q = "SELECT * FROM account WHERE acct_id = ? LIMIT 1";
    $stmt = mysqli_prepare ($con, $q);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $r = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($r);
    $status = $row['status'];

    include "includes/header-account.php";
    
    if ($status === 'DORMANT') {
        redirect('./login');
    }elseif($status === 'REGISTERED'){
        redirect('./welcome');
    }elseif($status === 'SUSPENDED'){
        redirect('./login');
    }
    
    $limit = 10;
    $page = isset($_GET['page']) ? $_GET['page'] : 1; //current page number
    $offset = ($page - 1) * $limit; //calculate offset
    
    $q2 = "SELECT * FROM transfer WHERE acct_id = ?";
    $stmt2 = mysqli_prepare($con, $q2);
    mysqli_stmt_bind_param($stmt2, 'i', $id);
    mysqli_stmt_execute($stmt2);
    $result = mysqli_stmt_get_result($stmt2);
    
    // Count the total number of rows that match the condition
    $total_rows = mysqli_num_rows($result);
    
    // Adjust the query to include LIMIT and OFFSET
    $q2 .= " ORDER BY date DESC LIMIT $limit OFFSET $offset";
    $stmt2 = mysqli_prepare($con, $q2);
    mysqli_stmt_bind_param($stmt2, 'i', $id);
    mysqli_stmt_execute($stmt2);
    $result = mysqli_stmt_get_result($stmt2);
    
    $numRows = mysqli_num_rows($result);
?>
<div class="top-section">
    <div class="balance">
        <div class="left">
            <p>Account Number</p>
            <p><?php echo $row['acct_no']; ?> </p>
        </div>
        <div class="right">
            <p><span class="bold-amount">Transfer History</span></p>
        </div> 
    </div>
    
    <?php
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
            $totalPages = ceil($total_rows / $limit);
            echo '<p style="border: none; text-align: center;">Page ';
                    for($i = 1; $i <= $totalPages; $i++){
                        echo '<a href="?page=' . $i . '">' . $i . '  </a>';
                    }
            echo '</p>';
        }else{
            echo '<div class="history">
                            <div class="left">
                                <h4>No Available Transactions..</h4>
                            </div>
                        <div>';
        }
    ?>
</div>
<?php include "includes/footer-account.php"; ?>
