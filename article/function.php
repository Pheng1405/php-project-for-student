<!-- @import jquery & sweet alert  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php 
// @Connection database
    $con = new mysqli('', 'root', '', 'cms_news');


    function getWebsiteLogo($type){
        global $con;
        $sql = "SELECT * FROM `tbl_header_logo` WHERE status = '$type' ORDER BY id DESC LIMIT 1;";
        $rs  = $con->query($sql);
        $row = mysqli_fetch_assoc($rs);

        $thumbnail = $row['thumbnail'];  

        return $thumbnail;
    }
    // getWebsiteLogo($type);

    function get_sport_news_on_homepage(){
        global $con;
        $sql_select = "SELECT * FROM `tbl_news` WHERE news_type = 'sport' ORDER BY id DESC LIMIT 3";
        $rs         = $con->query($sql_select);
        
        while($row = mysqli_fetch_assoc($rs)){
            echo '
                <div class="col-4">
                    <figure>
                        <a href="news-detail.php?id='.$row['id'].'" target="_blank">
                            <div class="thumbnail">
                                <img src="../admin/assets/image/'.$row['thumbnail'].'" alt="">
                            <div class="title">
                                '.$row['title'].'
                            </div>
                            </div>
                        </a>
                    </figure>
                 </div>
            
            ';
        }
    }

    function get_social_news_on_homepage(){
        global $con;
        $sql = "SELECT * FROM `tbl_news` WHERE news_type = 'social' ORDER BY id DESC";
        $rs  = $con->query($sql);

        while($row = mysqli_fetch_assoc($rs)){
            echo '
                    <div class="col-4">
                        <figure>
                            <a href="news-detail.php?id='.$row['id'].'">
                                <div class="thumbnail">
                                    <img src="../admin/assets/image/'.$row['thumbnail'].'" alt="">
                                <div class="title">'.$row['title'].'</div>
                                </div>
                            </a>
                        </figure>
                    </div>
            ';

        }
    }


    function get_trending_news(){
        global $con;

        $sql = "SELECT * FROM `tbl_news` ORDER BY id DESC LIMIT 3";
        $rs  = $con->query($sql);

        while($row = mysqli_fetch_assoc($rs)){
            $title = $row['title'];
            $id    = $row['id'];
            echo '
                <i style="color: red" class="fas fa-angle-double-right"></i>
                <a  href="news-detail.php?id='.$id.'"> '.$title.' </a> &ensp;
            ';
        }


    }

    function feedback(){
        global $con;
        if(isset($_POST['btn_message'])){
            $name    = $_POST['name'];
            $email   = $_POST['email'];
            $phone   = $_POST['phone'];
            $address = $_POST['address'];
            $message = $_POST['description']; 
            $date    = date('Y-m-d');

            $sql_insert = "INSERT INTO `tbl_feedback`(`name`, `email`, `phone`, `address`, `description`, `created_at`)
                            VALUES ('$name','$email','$phone','$address','$message','$date')";
            $rs_insert  = $con->query($sql_insert);

            if($rs_insert){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Message Sent",
                                text: "We have recorded your message",
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
    feedback();

    // contact icon on contact body page
    function get_contact_us_icon(){
        global $con;
        $sql = "SELECT * FROM `tbl_follow_us` WHERE is_deleted = 0";
        $rs  = $con->query($sql);

        while($row = mysqli_fetch_assoc($rs)){
            echo '
                <li>
                    <img src="../admin/assets/image/'.$row['thumbnail'].'" width="40px"> <a href="'.$row['social_url'].'" target="_blank">'.$row['label'].'</a>
                </li>
            ';
        }
    }

    // contact icon on footer
    function get_contact_us_icon_footer(){
        global $con;
        $sql = "SELECT * FROM `tbl_follow_us` WHERE status = 1 AND is_deleted = 0";
        $rs  = $con->query($sql);

        while($row = mysqli_fetch_assoc($rs)){
            echo '
                    <li>
                        <img src="../admin/assets/image/'.$row['thumbnail'].'" width="40px"> <a href="'.$row['social_url'].'" target="_blank"></a>
                    </li>
            ';
        }
    }

    function get_main_news(){
        global $con;
        $sql_popular = "SELECT * FROM `tbl_news` WHERE is_deleted = 0 ORDER BY view DESC";
        $rs          = $con->query($sql_popular);

        $row = mysqli_fetch_assoc($rs);

        echo'
                <div class="col-8 content-left">
                <figure>
                    <a href="news-detail.php">
                        <div class="thumbnail">
                            <img src="../admin/assets/image/'.$row['banner'].'" alt="">
                            <div class="title">
                                '.$row['title'].'
                            </div>
                        </div>
                        
                    </a>
                </figure>
            </div>
        
        ';
         
    }
    function get_latest_news(){
        global $con;
        $sql_news = "SELECT * FROM `tbl_news` ORDER BY id DESC LIMIT 2";
        $rs_news  = $con->query($sql_news);
    
        while($row = mysqli_fetch_assoc($rs_news)){
            echo '
                    <div class="col-12">
                    <figure>
                        <a href="">
                            <div class="thumbnail">
                                <img src="../admin/assets/image/'.$row['thumbnail'].'" alt="">
                            <div class="title">
                            '.$row['title'].'
                            </div>
                            </div>
                        </a>
                    </figure>
                </div>
            ';
        }
    }
?>