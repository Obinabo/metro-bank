<?php
$qAccount = "SELECT * FROM account";
$stmtAccount = mysqli_prepare($con, $qAccount);
mysqli_stmt_execute($stmtAccount);
$rAccount = mysqli_stmt_get_result($stmtAccount);
$accountNumRows = mysqli_num_rows($rAccount);


$qTrans = "SELECT * FROM transfer";
$stmtTrans = mysqli_prepare($con, $qTrans);
mysqli_stmt_execute($stmtTrans);
$rTrans = mysqli_stmt_get_result($stmtTrans);
$transNumRows = mysqli_num_rows($rTrans);


$qTicket = "SELECT * FROM ticket";
$stmtTicket = mysqli_prepare($con, $qTicket);
mysqli_stmt_execute($stmtTicket);
$rTicket = mysqli_stmt_get_result($stmtTicket);
$ticketNumRows = mysqli_num_rows($rTicket);


$pend = 'DORMANT';
$qStat = "SELECT * FROM account WHERE status = ?";
$stmtStat = mysqli_prepare($con, $qStat);
mysqli_stmt_bind_param($stmtStat, 's', $pend);
mysqli_stmt_execute($stmtStat);
$rStat = mysqli_stmt_get_result($stmtStat);
$statNumRows = mysqli_num_rows($rStat);


$active = 'ACTIVE';
$qActive = "SELECT * FROM account WHERE status = ?";
$stmtActive = mysqli_prepare($con, $qActive);
mysqli_stmt_bind_param($stmtActive, 's', $active);
mysqli_stmt_execute($stmtActive);
$rActive = mysqli_stmt_get_result($stmtActive);
$activeNumRows = mysqli_num_rows($rActive);


$susp = 'SUSPENDED';
$qSusp = "SELECT * FROM account WHERE status = ?";
$stmtSusp = mysqli_prepare($con, $qSusp);
mysqli_stmt_bind_param($stmtSusp, 's', $susp);
mysqli_stmt_execute($stmtSusp);
$rSusp = mysqli_stmt_get_result($stmtSusp);
$suspNumRows = mysqli_num_rows($rSusp);

?>