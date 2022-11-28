<?php 
    include('sidebar.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Update Sport News</h3>
                        </div>
                        <?php
                            $news_id = $_GET['id']; 
                            $sql = "SELECT * FROM `tbl_news` WHERE id = '$news_id'";
                            $rs  = $con->query($sql);
                            $row = mysqli_fetch_assoc($rs);

                            $title       = $row['title'];
                            $news_type   = $row['news_type'];
                            $category    = $row['categories'];
                            $thumbnail   = $row['thumbnail'];
                            $banner      = $row['banner'];
                            $description = $row['description'];

                            $selected_national = '';
                            $selected_international = '';
                            if($category == 'national') $selected_national = 'selected';
                            else  $selected_international = 'selected';
                        ?>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" value="<?=$title?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Type</label>
                                        <input type="text" class="form-control" name="news_type" value="<?=$news_type?>" readonly>
                                    </div>
                                    

                                    <div class="form-group">
                                        <label for="">Categories</label>
                                        <select name="category" class="form-select">
                                            <option value="national" <?php echo $selected_national ?>>National</option>
                                            <option value="international" <?php echo $selected_international ?>>International</option>
                                        </select>
                                    </div>

                                    <img src="assets/image/<?=$thumbnail?>" width="150" height="100">
                                    <div class="form-group">
                                        <label>Thumbnail <small style="color: orange;" >(Recommended : 350 x 200 pixel)</small></label>
                                        <input type="file" class="form-control" name="thumbnail">
                                    </div>

                                    <img src="assets/image/<?=$banner?>"  width="150" height="100">
                                    <div class="form-group">
                                        <label>Banner <small style="color: orange;" >(Recommended : 730 x 415 pixel)</small> </label>
                                        <input type="file" class="form-control" name="banner">
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description" value=>
                                            <?php echo $description ?>
                                        </textarea>
                                    </div>

                                    <!-- @hidden-id -->
                                    <input type="hidden" value="<?=$news_id?>" name="news_id">
                                    <div class="form-group">
                                        <button class="btn btn-success" name="update_sport_post">Update</button>
                                        <a href="sport-view-post.php" class="btn btn-primary">View Post</a>
                                    </div>


                                </form>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>