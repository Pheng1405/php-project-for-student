<script src="assets/js/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
    $con = new  mysqli('','root', '', 'cms_news');
    session_start();

    function register(){
        global $con;
        if(isset($_POST['btn_register'])){
            $username = $_POST['username'];
            $email    = $_POST['email'];
            $password = md5($_POST['password']);
            $profile  = date('YmdHms').'-'. $_FILES['profile']['name'];
            $path     = 'assets/icon/'.$profile;

            if(!empty($username) && !empty($email) && !empty($password) &&  !empty($password) && !empty($profile) ){
                move_uploaded_file($_FILES['profile']['tmp_name'], $path);

                $sql  = "INSERT INTO `tbl_user`(`name`, `email`, `password`, `profile`)
                         VALUES ('$username', '$email', '$password', '$profile')";
                $rs   = $con->query($sql);

                if($rs){
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Signup successfully",
                                text: "Now you can use admin dashboard",
                                icon: "success",
                                button: "OK",
                              });
                        });
                    </script>
                    ';
                }
                else{
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "ERROR",
                                text: "Found an Error occur",
                                icon: "error",
                                button: "OK",
                              });
                        });
                    </script>
                    ';
                }
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "ERROR",
                                text: "Please Fill All Information!",
                                icon: "error",
                                button: "OK",
                              });
                        });
                    </script>
                ';
            }
            
            
        }
    }
    register();

    
    function upload_file($file_name) {
        $name = date('YmdHis') .'-'. $_FILES[$file_name]['name'];
        $path      = 'assets/image/' . $name;
        move_uploaded_file($_FILES[$file_name]['tmp_name'], $path);
        return $name;
    }

    function login(){ 
        global $con;
        if(isset($_POST['btn_login'])){
            $name_email  = $_POST['name_email'];
            $password    = $_POST['password'];
            $cf_password = $_POST['cf_password'];
            
            if(!empty($name_email) && !empty($password) && !empty($cf_password)){
                $password = md5($password);
                $cf_password = md5($cf_password);
                if($password == $cf_password){
                    $sql = "SELECT *
                            FROM `tbl_user`
                            WHERE (name = '$name_email' OR email = '$name_email')
                            AND password = '$password' 
                            ";
                    $rs  = $con->query($sql);
                    $row = mysqli_fetch_assoc($rs);
                    if(!empty($row)){
                        $user_id = $row['id'];
                        $_SESSION['user'] =  $user_id;
                        header('location: index.php?msg=true'); 
                        // echo $_SESSION['user'];
                    }
                    else{
                        echo '
                            <script>
                                $(document).ready(function(){
                                    swal({
                                        title: "ERROR",
                                        text: "Can not found user",
                                        icon: "error",
                                        button: "Try Again",
                                        
                                    });
                                });
                            </script>
                    ';    
                    }
                }
                else{
                    echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "ERROR",
                                    text: "Password must be matched",
                                    icon: "error",
                                    button: "OK",
                                    
                                });
                            });
                        </script>
                    ';
                }
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "ERROR",
                                text: "Please Fill All Information!",
                                icon: "error",
                                button: "OK",
                              });
                        });
                    </script>
                ';
            }
        }
        
    }
    login();

    function logout(){
        if(isset($_POST['btn_yes'])){
            unset($_SESSION['user']);
            header('Location: login.php');
        }
        if(isset($_POST['btn_no'])){
            header('Location: index.php');
        }
    }
    logout();

    function update_profile(){
        global $con;
        if(isset($_POST['update_pf_btn'])){
            $update_name    = $_POST['update-name'];
            $update_email   = $_POST['update-email'];
            $update_profile = $_FILES['update-profile']['name'];

            $id   = $_SESSION['user'];
           

            $sql = "SELECT * FROM `tbl_user` WHERE id = '$id'";
            $rs  = $con->query($sql);
            $row = mysqli_fetch_assoc($rs);

            if(empty($update_profile)){
                $update_profile = $row['profile'];
            }
            else{
                $update_profile = date('YmdHms').'-'.$update_profile;
                $path = 'assets/icon/'.$update_profile;
                move_uploaded_file($_FILES['update-profile']['tmp_name'], $path);
            }
            $sql_update = "UPDATE `tbl_user` 
                            SET `name`='$update_name',`email`='$update_email',`profile`='$update_profile'
                            WHERE id = '$id' ";
            $rs_update  = $con->query($sql_update);

            if($rs_update){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Update Successful",
                                icon: "success",
                                timer:3000,
                            });
                        });
                    </script>
                    ';
}
            }
        if(isset($_POST['cancel_pf_btn'])){
            Header('Location: index.php');
        }

    }
    update_profile();


    function add_website_logo(){
        global $con;
        if(!empty($_SESSION['user'])){
            $user_id = $_SESSION['user'];
        }
        if(isset($_POST['add_web_logo'])){
            $logo    = $_FILES['logo']['name'];
            $show_on = $_POST['logo_type'];
            if(!empty($logo)){
                $logo = date('YmdHis').'-'.$logo;
                $path = 'assets/image/'.$logo;
                move_uploaded_file($_FILES['logo']['tmp_name'], $path);

                //Upload Logo
                $sql = "INSERT INTO `tbl_header_logo`(`thumnail`, `status`)
                         VALUES ('$logo','$show_on')";
                $rs  = $con->query($sql);
                // get admin
                $sql_getAdmin = "SELECT * FROM `tbl_user` WHERE id = '$user_id'";
                $rs_getAdmin  = $con->query($sql_getAdmin);
                $row = mysqli_fetch_assoc($rs_getAdmin);
                $admin_name = $row['name']; 
                if($rs){
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Add Successfully",
                                text: "Website logo has been update by admin '.$admin_name.'",
                                icon: "success",
                                button: "OK",
                              });
                        });
                    </script>
                    ';
                }
                else{
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "ERROR",
                                text: "Something went wrong",
                                icon: "error",
                                button: "OK",
                              });
                        });
                    </script>
                    ';
                }

            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "ERROR",
                                text: "Please Fill All Information!",
                                icon: "error",
                                button: "OK",
                              });
                        });
                    </script>
                ';
            }

        }
        
    }
    add_website_logo();

    function view_website_logo(){
        global $con;
        $sql = "SELECT * FROM `tbl_header_logo` WHERE trash = 0 ORDER BY id DESC";
        $rs  = $con->query($sql);
        while($row = mysqli_fetch_assoc($rs)){
            $post_id   = $row['id'];
            $thumbnail = $row['thumbnail'];
            $show_on   = $row['status'];
            echo '
                    <tr>
                        <td><img src="assets/image/'.$thumbnail.'" width="120" height="120" style="object-fit: cover"></td>
                        <td>'.$show_on.'</td>
                        <td>
                            <a href="update-logo.php?logo-id='.$post_id.'" class="btn btn-primary" >Update</a>
                            <button type="button" class="btn btn-danger btn-remove" remove-id="'.$post_id.'"  data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>

                        </td>
                    </tr>
            ';
        }
    }

    function delete_logo(){
        global $con;
        if(isset($_POST['accept_delete'])){

            $remove_id = $_POST['remove_id'];
            
            $sql = "UPDATE `tbl_header_logo` 
                    SET `trash`= 1 WHERE id = '$remove_id'";
            $rs = $con->query($sql);
            if($rs){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Delete Successful",
                                text: "Website logo has been delete",
                                icon: "success",
                                button: "OK",
                              });
                        });
                    </script>
                    ';
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "ERROR",
                                text: "Something went wrong",
                                icon: "error",
                                button: "Try again",
                              });
                        });
                    </script>
                    ';
            }
        }
    }
    delete_logo();

    function update_logo(){
        global $con;
        if(isset($_POST['update_web_logo'])){
            $show_on = $_POST['logo_type'];
            $logo    = $_FILES['logo']['name'];
            $logo_id = $_GET['logo-id'];
            $sql = "SELECT * FROM `tbl_header_logo` WHERE $logo_id";
            $rs  = $con->query($sql);
            $row = mysqli_fetch_assoc($rs);
            
            if(empty($logo)){
               $logo = $row['thumbnail']; 
            }
            else{
                $logo = date('YmdHis').'-'.$logo;
                $path = 'assets/image/'.$logo;
                move_uploaded_file($_FILES['logo']['tmp_name'], $path);
            }


            $sql_update = "UPDATE `tbl_header_logo`
                         SET `thumbnail`='$logo',
                             `status`='$show_on'
                        WHERE id = $logo_id";
            $rs_update  = $con->query($sql_update);

            if($rs_update){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Update Successful",
                                text: "Website logo has been update",
                                icon: "success",
                                button: "OK",
                              });
                        });
                    </script>
                    ';
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "ERROR",
                                text: "Something went wrong",
                                icon: "error",
                                button: "Try Again",
                              });
                        });
                    </script>
                    ';
            }
        }
    }
    update_logo();

    function add_sport_news(){
        global $con;

        if(isset($_POST['sport_publish'])){
            $author_id   = $_SESSION['user'];
            $title       = $_POST['title'];
            $new_type    = $_POST['news_type'];
            $category    = $_POST['category'];
            $thumbnail   = upload_file('thumbnail');
            $banner      = upload_file('banner');
            $description = $_POST['description'];
            $created_at   = date('Y-m-d');
            $is_deleted  = 0; 
            $view        = 0;

            $sql = "INSERT INTO `tbl_news`
                            (`author_id`, `title`, `news_type`, `categories`, `thumbnail`, `banner`, `description`, `view`, `is_deleted`, `created_at`)
                    VALUES ('$author_id','$title','$new_type','$category','$thumbnail','$banner','$description','$view','$is_deleted','$created_at')
            ";
            
            $rs  = $con->query($sql);
            if($rs){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "News has been published",
                                icon: "success",
                                button: "OK",
                              });
                        });
                    </script>
                    ';
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "ERROR",
                                text: "Something went wrong",
                                icon: "error",
                                button: "Try Again",
                              });
                        });
                    </script>
                    ';
            }
        }

    }
    add_sport_news();


    function view_sport_news(){
        global $con;
        $sql = "SELECT t_news.*, t_user.name 
                FROM `tbl_news` AS t_news INNER JOIN `tbl_user` AS t_user 
                ON t_news.author_id = t_user.id 
                WHERE is_deleted = 0 AND news_type = 'sport'
                ORDER BY id DESC;";

        $rs  = $con->query($sql);

        while($row = mysqli_fetch_assoc($rs)){
            $title       = $row['title'];
            $new_type    = $row['news_type'];
            $category    = $row['categories'];
            $thumbnail   = $row['thumbnail'];
            $view        = $row['view'];
            $created_at  = $row['created_at'];
            $author      = $row['name'];
            $news_id     = $row['id'];
            echo'
                <tr>
                    <td width="25%">'.$title.'</td>
                    <td>'.$new_type.'</td>
                    <td>'.$category.'</td>
                    <td>
                        <img src="assets/image/'.$thumbnail.'" width="100" height="50">
                    </td>
                    <td>'.$view.'</td>
                    <td>'.$created_at.'</td>
                    <td>'.$author.'</td>
                    <td width="150px">
                        <a href="sport-update-post.php?id='.$news_id.'"  class="btn btn-primary">Update</a>
                        <button type="button" remove-id="'.$news_id.'"  class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Remove
                        </button>
                    </td>
                </tr>

            ';
        }

        

    }
    
    function delete_sport_new(){
        global $con;
        if(isset($_POST['accept_delete_post'])){
            $remove_id = $_POST['remove_id'];
            $sql = "UPDATE `tbl_news`
                     SET `is_deleted`= 1 
                    WHERE id = '$remove_id'";
            $rs  = $con->query($sql);

            if($rs){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "SUCCESS",
                                text: "Post has been deleted !",
                                icon: "success",
                                button: "OK",
                              });
                        });
                    </script>
                    ';
            }
            else{
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "ERROR",
                            text: "Something went wrong",
                            icon: "error",
                            button: "Try again",
                          });
                    });
                </script>
                ';
            }

        }
    }
    delete_sport_new();


    function update_sport_post(){
        global $con;
        if(isset($_POST['update_sport_post'])){
            $author_id   = $_SESSION['user'];
            $title       = $_POST['title'];
            $new_type    = $_POST['news_type'];
            $category    = $_POST['category'];
            $thumbnail   = $_FILES['thumbnail']['name'];
            $banner      = $_FILES['banner']['name'];
            $description = $_POST['description'];
            $created_at   = date('Y-m-d');
            $news_id      = $_POST['news_id'];

            // get_current_news_information

            $sql = "SELECT * FROM `tbl_news` WHERE id = '$news_id'";
            $rs  = $con->query($sql);
            $row = mysqli_fetch_assoc($rs);

            $old_thumbnail = $row['thumbnail'];
            $old_banner    = $row['banner'];

            if(empty($thumbnail)){
                $thumbnail = $old_thumbnail;
            }
            else{
                $thumbnail = upload_file('thumbnail');
            }

            if(empty($banner)){
                $banner = $old_banner;
            }
            else{
                $banner = upload_file('banner');
            }

            $sql_update = "UPDATE `tbl_news`
                           SET `author_id`='$author_id',`title`='$title',`news_type`='$new_type',`categories`='$category',
                                `thumbnail`='$thumbnail',`banner`='$banner',`description`='$description',`created_at`='$created_at'
                           WHERE id = $news_id";
            $rs_update = $con->query($sql_update);
        
            
            if($rs_update){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "SUCCESS",
                                text: "Post has been update !",
                                icon: "success",
                                button: "OK",
                              });
                        });
                    </script>
                    ';
            }
            else{
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "ERROR",
                            text: "Something went wrong",
                            icon: "error",
                            button: "Try again",
                          });
                    });
                </script>
                ';
            }

        }
    }
    update_sport_post();


    function feedback_view_post(){
        global $con;
        $sql = "SELECT * FROM `tbl_feedback` WHERE is_deleted = 0 ORDER BY id DESC";
        $rs  = $con->query($sql);

        while($row = mysqli_fetch_assoc($rs)){
            $post_id     = $row['id'];
            $name        = $row['name'];
            $email       = $row['email'];
            $phone       = $row['phone'];
            $address     = $row['address'];
            $description = $row['description'];
            $created_at  = $row['created_at'];

            echo '
                <tr>
                    <td>'.$name.'</td>
                    <td >'.$email.'</td>
                    <td>'.$phone.'</td>
                    <td>'.$address.'</td>
                    <td>'.$description.'</td>
                    <td>'.$created_at.'</td>
                    <td width="150px">
                        <a href="feedback-detail.php?post-id='.$post_id.'" class="btn btn-primary" >View</a>
                        <button type="button" remove-id="'.$post_id.'"  class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Remove
                        </button>
                    </td>
                </tr>
            
            
            ';

        }
        
    }
    function delete_feedback(){
        global $con;
        if(isset($_POST['accept_delete_feedback'])){
            $post_id = $_POST['remove_id'];
            $sql = "UPDATE `tbl_feedback` SET `is_deleted`= 1 WHERE id = '$post_id'";
            $rs  = $con->query($sql);

            if($rs){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "SUCCESS",
                                text: "Post has been deleted !",
                                icon: "success",
                                button: "OK",
                              });
                        });
                    </script>
                    ';
            }
            else{
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "ERROR",
                            text: "Something went wrong",
                            icon: "error",
                            button: "Try again",
                          });
                    });
                </script>
                ';
            }

            
        }
    }
    delete_feedback();


    function add_social_news(){
        global $con;
        if(isset($_POST['social_publish'])){
            $title       = $_POST['title'];
            $news_type   = $_POST['news_type'];
            $category    = $_POST['category'];
            $thumbnail   = upload_file('thumbnail');
            $banner      = upload_file('banner');
            $author_id     = $_SESSION['user'];
            $description = $_POST['description'];
            $created_at  = date('Y-m-d');
            $view        = 0;
            
            $sql = "INSERT INTO `tbl_news`(`author_id`, `title`, `news_type`, `categories`, `thumbnail`, `banner`, `description`, `view`, `created_at`)
                     VALUES ('$author_id','$title','$news_type','$category','$thumbnail','$banner','$description','$view','$created_at')";
            $rs  = $con->query($sql);
            
            if($rs){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "News has been published",
                                icon: "success",
                                button: "OK",
                              });
                        });
                    </script>
                    ';
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "ERROR",
                                text: "Something went wrong",
                                icon: "error",
                                button: "Try Again",
                              });
                        });
                    </script>
                    ';
            }
        }
    }
    add_social_news();

    function view_social_news(){

        global $con;
        $sql = "SELECT t_news.*, t_user.name FROM `tbl_news` AS t_news INNER JOIN `tbl_user` AS t_user WHERE news_type = 'social' AND t_user.id = t_news.author_id";
        $rs  = $con->query($sql);

        while($row = mysqli_fetch_assoc($rs)){
            $title = $row['title'];
            $news_type = $row['news_type'];
            $category  = $row['categories'];
            $thumbnail = $row['thumbnail'];
            $view      = $row['view'];
            $created_at= $row['created_at'];
            $author    = $row['name'];
            $news_id   = $row['id'];
            echo'
                <tr>
                    <td width="25%">'.$title.'</td>
                    <td>'.$news_type.'</td>
                    <td>'.$category.'</td>
                    <td>
                        <img src="assets/image/'.$thumbnail.'" width="100" height="50">
                    </td>
                    <td>'.$view.'</td>
                    <td>'.$created_at.'</td>
                    <td>'.$author.'</td>
                    <td width="150px">
                        <a href="sport-update-post.php?id='.$news_id.'"  class="btn btn-primary">Update</a>
                        <button type="button" remove-id="'.$news_id.'"  class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Remove
                        </button>
                    </td>
                </tr>
            ';
        }

    }



    
    function contact_add_post(){
        global $con;
        if(isset($_POST['contact_submit'])){
            if(!empty($_FILES['thumbnail']['name'])){
                $label = $_POST['label'];
                $url   = $_POST['url'];
                $thumbnail = upload_file('thumbnail');
                $status  = 0; // 0 means display only contact us body page and 1 means display on both body and footer
                if(!empty($_POST['apply_on_footer'])){
                    $status = 1;
                }
                
                $sql = "INSERT INTO `tbl_follow_us`(`label`, `thumbnail`, `social_url`, `status`)
                                 VALUES ('$label','$thumbnail','$url','$status')";
                $rs  = $con->query($sql);
                if($rs){
                    echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Success",
                                    text: "Icon has been published",
                                    icon: "success",
                                    button: "OK",
                                  });
                            });
                        </script>
                        ';
                }
                else{
                    echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "ERROR",
                                    text: "Something went wrong",
                                    icon: "error",
                                    button: "Try Again",
                                  });
                            });
                        </script>
                        ';
                }
            }
             
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "ERROR",
                                text: "Please Fill All Information!",
                                icon: "error",
                                button: "OK",
                              });
                        });
                    </script>
                ';
            }
        }
    }
    contact_add_post();

    function contact_update_post(){
        global $con;
        if(isset($_POST['contact_update'])){
            if(!empty($_FILES['thumbnail']['name'])){
                $thumbnail = upload_file('thumbnail');
            }
            else{
                $thumbnail = $_POST['old_thumbnail'];
            }
            $post_id = $_POST['post_id'];
            $label = $_POST['label'];
            $url   = $_POST['url'];
            $status  = 0; // 0 means display only contact us body page and 1 means display on both body and footer
            
            if(!empty($_POST['apply_on_footer'])){
                $status = 1;
            }

            $sql = "UPDATE `tbl_follow_us` 
            SET `label`='$label',`thumbnail`='$thumbnail',`social_url`='$url',`status`='$status' WHERE id = $post_id";
            $rs  = $con->query($sql);
            if($rs){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "Icon has been updated",
                                icon: "success",
                                button: "OK",
                              });
                        });
                    </script>
                    ';
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "ERROR",
                                text: "Something went wrong",
                                icon: "error",
                                button: "Try Again",
                              });
                        });
                    </script>
                    ';
            }

        }
    }
    contact_update_post();

    function contact_view_post(){
        global $con;

        $sql = "SELECT * FROM `tbl_follow_us` WHERE is_deleted = 0";
        $rs  = $con->query($sql);

        while($row = mysqli_fetch_assoc($rs)){
            if($row['status']==1){
                $show_on_footer = "Yes";
            }
            else{
                $show_on_footer = "No";
            }
            echo'
                <tr>
                    <td width="25%">'.$row['label'].'</td>
                    <td>'.$row['label'].'</td>
                    <td >
                        <img src="assets/image/'.$row['thumbnail'].'" width="60" height="60">
                    </td>
                    <td>'.$show_on_footer.'</td>
                    <td width="150px">
                        <a href="contact-update-post.php?id='.$row['id'].'"  class="btn btn-primary">Update</a>
                        <button type="button" remove-id="'.$row['id'].'"   class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Remove
                        </button>
                    </td>
                </tr>
            ';
        }
    }
    function contact_delete_post(){
        global $con;
        if(isset($_POST['accept_delete_thumbnail'])){
            $post_id = $_POST['remove_id'];
            $sql = "UPDATE `tbl_follow_us` SET `is_deleted`= 1 WHERE id = '$post_id'";
            $rs  = $con->query($sql);

            if($rs){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "Icon has been deleted",
                                icon: "success",
                                button: "OK",
                              });
                        });
                    </script>
                    ';
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "ERROR",
                                text: "Something went wrong",
                                icon: "error",
                                button: "Try Again",
                              });
                        });
                    </script>
                    ';
            }
        }
    }
    contact_delete_post();

?>