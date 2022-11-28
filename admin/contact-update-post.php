<?php 
    include('sidebar.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Contact</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">

                                    <?php 
                                        $post_id = $_GET['id'];

                                        $sql = "SELECT * FROM `tbl_follow_us` WHERE id = $post_id;";
                                        $rs  = $con->query($sql);
                                        $row = mysqli_fetch_assoc($rs);

                                        $checked = $row['status'] ?  "checked" : "";
                                        
                                    ?>
                                    <input type="hidden" name="post_id" value="<?=$post_id?>">
                                    <input type="hidden" name="old_thumbnail" value="<?=$row['thumbnail']?> ">
                                    <div class="form-group">
                                        <label>Label</label>
                                        <input type="text" class="form-control" name="label" value="<?=$row['label'];?>">
                                    </div>

                                    <div class="form-group">
                                        <label>URL</label>
                                        <input type="text" class="form-control" name="url" value="<?=$row['social_url'];?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Current Thumbnail</label><br>
                                        <img src="../admin/assets/image/<?=$row['thumbnail']?>" width="60"  alt=""> <br><br>
                                        <label>New Thumbnail</label>
                                        <input type="file" class="form-control" name="thumbnail">
                                    </div>

                                    <div class="form-group">
                                        <label>Apply on footer</label>
                                        <input type="checkbox" class="form-check-input" name="apply_on_footer" <?php echo $checked;?> >
                                    </div>

                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" name="contact_update">Update</button>
                                        <a href="contact-view-post.php" style="border-radius: 0px" class="btn btn-primary">View Posts</a>
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