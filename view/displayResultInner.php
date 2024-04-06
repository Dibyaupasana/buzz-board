<?php
include_once('../db.php');

$readdata = new DB();

$txtrollno = (isset($_REQUEST['txtrollno']) && $_REQUEST['txtrollno'] != '') ? $_REQUEST['txtrollno'] : '';

$concatquery = (!empty($txtrollno) && isset($txtrollno)) ? "  WHERE s.roll_no = '$txtrollno' ": "";
$sql = 'SELECT
    s.student_id,
    s.roll_no,
    s.name,
    s.gender,
    c.class
FROM
    students s
LEFT JOIN
    marks m ON s.student_id = m.student_id
LEFT JOIN
    classes c ON m.class_id = c.class_id'
    .$concatquery.'
    
    group by s.student_id
';
//echo $sql;exit;
$result =  $readdata->executeQuery($sql);

if(!empty($result)){
    $intRecno = $result->num_rows;
}



//$rst = $getResult->fetch_array();

//echo '<pre>';print_R($fetchRec);exit;
