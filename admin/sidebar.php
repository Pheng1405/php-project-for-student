<!DOCTYPE html>
<html lang="en">
<?php
    include('function.php');
    if($_SESSION['user']){
        $user_id = $_SESSION['user'];
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- @theme style -->
    <link rel="stylesheet" href="assets/style/theme.css">

    <!-- @Bootstrap -->
    <link rel="stylesheet" href="assets/style/bootstrap.css">

    <!-- @script -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/bootstrap.js"></script>

    <!-- @tinyACE -->
    <script src="https://cdn.tiny.cloud/1/5gqcgv8u6c8ejg1eg27ziagpv8d8uricc4gc9rhkbasi2nc4/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


</head>
<body>
    <main class="admin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2">
                    <div class="content-left">
                        <div class="wrap-top">
                            <img src="assets/icon/admin-logo.png" alt="">
                            <h5>Jong Deng News </h5>
                        </div>
                        <?php
                            $user_id = $_SESSION['user'];
                            $sql = "SELECT * FROM `tbl_user` WHERE id = $user_id";
                            $rs  = $con->query($sql);
                        
                            $row = mysqli_fetch_assoc($rs);
                        
                            $username = $row['name'];
                            $profile  = $row['profile'];
                        ?>
                        <div class="wrap-center">
                            <img  src="assets/icon/<?=$profile?>" alt="" width="50px" height="50px" style="object-fit = cover;">
                            <h6>Welcome Admin <?php echo $username?> </h6>
                        </div>
                        <div class="wrap-bottom">
                            <ul>
                                <!-- Main -->
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>MAIN MENU</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="view-post.php">View Post</a>
                                            <a href="add-post.php">Add New</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Website Logo -->
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>Website Logo</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="website-logo-view-post.php">View Post</a>
                                            <a href="add-website-logo.php">Add New</a>
                                            <a href="restore-website-logo.php">Restore</a>
                                        </li>
                                    </ul>
                                </li>


                                <!-- Sport News -->
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>Sport News</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="sport-view-post.php">View Post</a>
                                            <a href="sport-add-post.php">Add New</a>
                                            
                                        </li>
                                    </ul>
                                </li>


                                <!-- Social News -->
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>Social News</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="social-view-post.php">View Post</a>
                                            <a href="social-add-post.php">Add New</a>
                                            
                                        </li>
                                    </ul>
                                </li>

                                <!-- Contact -->
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>Contact</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="contact-view-post.php">View Post</a>
                                            <a href="contact-add-post.php">Add New</a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- Feedbacks -->
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>Feedbacks</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="feedback-view-post.php">View Post</a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- Edit profile -->
                                <li class="parent">
                                    <a class="parent" href="update-user.php">
                                        <span>Edit Profile</span>
                                    </a>
                                    
                                </li>
                                <!-- logout -->
                                <li class="parent">
                                    <a class="parent" href="logout.php">
                                        <span>Logout</span>
                                    </a>
                                </li>
                            
                            </ul>
                            
                        </div>
                    </div>
                </div>

<?php
    }
    else{
        header('Location: login.php');
    }

?>