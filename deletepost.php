<?php include '../lib/session.php';
session::checkSession();
?>

<?php include "../config/config.php"; ?>
<?php include "../lib/Database.php"; ?>
<?php include "../helpers/format.php"; ?>
<!-- start object-->
<?php
$db = new Database();
?>
<?php
if (!isset($_GET['deletepostid']) || $_GET['deletepostid'] == NULL) {
    echo "<script>window.Location='postlist.php';</script>";
} else {
    $postid = $_GET['deletepostid'];

    $query = "SELECT * FROM tbl_post WHERE `id`='$postid'";
    $getdata = $db->select($query);
    if ($getdata) {
        while ($delimg = $getdata->fetch_assoc()) {
            $dellink = $delimg['image'];
            unlink($dellink);
        }
    }
    $delquery = "DELETE FROM tbl_post WHERE `id`='$postid'";
    $deldata = $db->delete($delquery);
    if ($deldata) {
        echo "<script>alert('Post Deleted Successfully..');</script>";
        echo "<script>window.Location='postlist.php';</script>";
    } else {
        echo "<script>alert('Post Not Deleted..');</script>";
        echo "<script>window.Location='postlist.php';</script>";
    }
}
?>