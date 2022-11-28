<?php include('header.php'); ?>
<main class="sport">
    <section class="trending">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-trending">
                        <div class="content-left">
                            RESULT SEARCH
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <div class="row">
                <?php
                    $query = $_GET['query'];
                    $sql = "SELECT * FROM `tbl_news` WHERE title LIKE '%$query%' ORDER BY id DESC";
                    $rs  = $con->query($sql);

                    while($row = mysqli_fetch_assoc($rs)){
                        $title       = $row['title'];   
                        $description = $row['description'];
                        $post_id     = $row['id'];
                        $thumbnail   = $row['thumbnail'];
                        $created_at  = $row['created_at'];
                        $created_at  = date('d-M-Y', strtotime($created_at));

                        echo '
                                <div class="col-4">
                                    <figure>
                                        <a href="/cms/article/news-detail.php?id='.$post_id.'">
                                            <div class="thumbnail">
                                                <img src="../admin/assets/image/'.$thumbnail.'" alt="">
                                            </div>
                                            <div class="detail">
                                                <h3 class="title">'.$title.'</h3>
                                                <div class="date">'.$created_at.'</div>
                                                <div class="description">'.$description.'</div>
                                            </div>
                                        </a>
                                    </figure>
                                </div>
                        ';
                    }

                ?>

                
            </div>
        </div>
    </section>
</main>
<?php include('footer.php'); ?>