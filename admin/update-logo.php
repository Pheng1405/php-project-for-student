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
                                <form method="post" enctype="multipart/form-data">
                                    <?php
                                        $logo_id = $_GET['logo-id'];
                                        $sql = "SELECT * FROM `tbl_header_logo` WHERE id = '$logo_id'";
                                        $rs  = $con->query($sql);
                                        $row = mysqli_fetch_assoc($rs);

                                        $logo = $row['thumbnail'];
                                        $type = $row['status'];

                                        $selected = '';
                                        $selected_header = '';
                                        $selected_footer = '';
                                        if($type == 'header'){
                                            $selected_header = 'selected';
                                        }
                                        else{
                                            $selected_footer = 'selected';
                                        }

                                        //TO do
                                        

                                    ?>
                                    <img src="assets/image/<?=$logo?>" alt="" width ="120" height="120">
                                   <div class="form-group">
                                       <label>Show on : </label>
                                       <select class="form-select" name="logo_type">
                                           <option value="header" <?=$selected_header?>>Header</option>
                                           <option value="footer" <?=$selected_footer?>>Footer</option>
                                       </select>
                                   </div>
                                   
                                   <div class="form-group">
                                        <img src="" alt="">
                                       <label>File <small style="color: orange;" >(Recommended : 300 x 80 pixel for header & 120 x 120 px for footer)</small> </label>
                                       <input type="file" class="form-control" name="logo">
                                   </div>
                                   
                                   <div class="form-group">
                                       <button type="submit" class="btn btn-success" name="update_web_logo">Submit</button>
                                       <button type="submit" class="btn btn-primary" name="view_post">View Post</button>
                                   </div>
                               </form>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
