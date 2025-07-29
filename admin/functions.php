<?php
include("../includes/db.php");


function countStudent()
{
    global $conn;
    $sql = "SELECT * FROM tblstudents";
    $result = $conn->query($sql);
    $count_students = $result->num_rows;
    return $count_students;
}
function countUser()
{
    global $conn;
    $sql = "SELECT * FROM tblusers";
    $result = $conn->query($sql);
    $count_users = $result->num_rows;
    return $count_users;
}
function hundredLevel()
{
    global $conn;
    $sql = "SELECT * FROM `tblpayment_reference` WHERE `level`='100lvl'";
    $result = $conn->query($sql);
    $count_lvl = $result->num_rows;
    return $count_lvl;
}
function twoHundredLevel()
{
    global $conn;
    $sql = "SELECT * FROM `tblpayment_reference` WHERE `level`='200lvl'";
    $result = $conn->query($sql);
    $count_lvl = $result->num_rows;
    return $count_lvl;
}
function threeHundredLevel()
{
    global $conn;
    $sql = "SELECT * FROM `tblpayment_reference` WHERE `level`='300lvl'";
    $result = $conn->query($sql);
    $count_lvl = $result->num_rows;
    return $count_lvl;
}
function fourHhundredLevel()
{
    global $conn;
    $sql = "SELECT * FROM `tblpayment_reference` WHERE `level`='400lvl'";
    $result = $conn->query($sql);
    $count_lvl = $result->num_rows;
    return $count_lvl;
}
function updStatus($level, $id)
{
    global $conn;
    $sql = "SELECT * FROM `tblpayment_reference` WHERE `stu_id` = $id AND `level`='$level' AND `status` = 'paid';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if (!empty($row['status']) && $row['status'] === 'paid') {
        return true;
    } else {
        return false;
    }
}
