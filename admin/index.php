<?php 
    include('sidebar.php');
    if(!empty($_GET['msg'])){
        $user_id = $_SESSION['user'];
        $sql = "SELECT * FROM `tbl_user`
                WHERE id =  $user_id";
        $rs  = $con->query($sql);
        $row = mysqli_fetch_assoc($rs);
        $username = $row['name'];
        echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Welcome Back",
                            text: "Admin '.$username.' ",
                            icon: "success",
                            timer:3000,
                            });
                        });
                </script>
            ';
    }
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3 class="text-center">Admin Dashboard</h3>
                        </div>
                        <div class="bottom view-post">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>