<?php
require_once('../../assets/session.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_1 = "UPDATE banner_contents SET status = '0'";
    $sql_2 = "UPDATE banner_contents SET status = '1' WHERE id = $id";
    mysqli_query($conn, $sql_1);

    if (mysqli_query($conn, $sql_2)) {
        $_SESSION['success'] = "Content activated successfully";
        header("Location: banner_content_view.php");
    } else {
        $_SESSION['error'] = mysqli_error($conn);
        header("Location: banner_content_view.php");
    }
} else {
    $_SESSION['error'] = 'Please select a content first.';
    header('location: banner_content_view.php');
}
