<?php
    include('sidebar.php');
?>
<div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Edit your profile</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <?php
                                    $sql = "SELECT * FROM `tbl_user` WHERE id = '$user_id'";
                                    $rs  = $con->query($sql);
                                    $row = mysqli_fetch_assoc($rs);
                                ?>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="update-name" value="<?=$row['name']?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="update-email"  value="<?=$row['email']?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Profile</label>
                                        <input type="file" class="form-control" name="update-profile">
                                        <img src="assets/icon/<?=$row['profile']?>" alt="" width="100" height="100" style="object-fit:cover; margin-top:20px">
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" name="update_pf_btn">Update</button>
                                        <button type="submit" class="btn btn-danger" name="cancel_pf_btn" >Cancel</button>
                                    </div>
                                </form>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
