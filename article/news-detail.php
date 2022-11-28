<?php
    include('header.php');
    $news_id = $_GET['id'];
    $sql_select = "SELECT t_news.*, t_user.name FROM `tbl_news` AS t_news INNER JOIN `tbl_user` AS t_user 
                   ON t_user.id = t_news.author_id AND t_news.id = '$news_id';";
    $rs = $con->query($sql_select);
    $row = mysqli_fetch_assoc($rs);

    $title        = $row['title'];
    $banner       = $row['banner'];
    $date         = $row['created_at'];
    $des          = $row['description'];
    $post_by      = $row['name'];
    $news_type    = $row['news_type'];

    $date = date("d/M/Y", strtotime($date));
    $view_count = $row['view'] + 1;
    $sever_name = $_SERVER['SERVER_NAME'];

    $sql_update = "UPDATE `tbl_news` SET `view`='$view_count' WHERE id = $news_id";
    $rs_update  = $con->query($sql_update);
?>
<main class="news-detail">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="main-news">
                        <div class="thumbnail">
                            <img src="../admin/assets/image/<?=$banner?>">
                        </div>
                        <div class="detail">
                            <h3 class="title"><?=$title?></h3>
                            <div class="date"><?=$date?></div>
                            <div class="description">
                                <?=$des?>
                            </div>
                            <div>Latest Updated : <?=$post_by?></div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="relate-news">
                        <h3 class="main-title">Related News</h3>
                        <?php
                            $sql = "SELECT * FROM `tbl_news` WHERE news_type = '$news_type' AND id NOT IN($news_id) ORDER BY id DESC LIMIT 2;";
                            $rs  = $con->query($sql);
                            
                            while($row = mysqli_fetch_assoc($rs)){
                                $related_id = $row['id'];
                                $related_title   = $row['title'];
                                $related_banner  = $row['banner'];
                                $related_thumbnail  = $row['thumbnail'];
                                $related_date    = $row['created_at'];
                                $related_des     = $row['description'];
                                $related_news    = $row['news_type'];

                                $related_date = date("d/M/Y", strtotime($related_date));
                                echo '
                                        <figure>
                                        <a href="news-detail.php?id='.$related_id.'">
                                            <div class="thumbnail">
                                                <img src="../admin/assets/image/'.$related_thumbnail.'" alt="">
                                            </div>
                                            <div class="detail">
                                                <h3 class="title">'.$related_title.'</h3>
                                                <div class="date">'.$related_date.'</div>
                                                <div class="description">
                                                    '.$related_des.'
                                                </div>
                                            </div>
                                        </a>
                                    </figure>
                                ';
                            }
                            
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('footer.php'); ?>