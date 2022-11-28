<?php
    include('sidebar.php');

?>
<div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Feedback Detail</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <?php
                                    $post_id = $_GET['post-id'];
                                    $sql = "SELECT * FROM `tbl_feedback` WHERE id = '$post_id'";
                                    $rs  = $con->query($sql);
                                    $row = mysqli_fetch_assoc($rs);
                                    
                                    $name        = $row['name'];
                                    $email       = $row['email'];
                                    $phone       = $row['phone'];
                                    $address     = $row['address'];
                                    $description = $row['description'];
                                    $created_at  = $row['created_at'];
                                    $created_at  = date('d-M-Y', strtotime($created_at));
                                ?>

                                <div class="card text-dark bg-white mb-3" style="max-width: 18rem;">
                                    <div class="card-header">
                                        <p>Name  : <?=$name?></p>
                                        <p>From  : <?=$address?></p>
                                        <p>Phone : <?=$phone?></p>
                                        <p>Email : <?=$email?></p>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?=$created_at?></h5>
                                        <p class="card-text"><?=$description?></p>
                                    </div>
                                    </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
