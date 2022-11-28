<?php 
    include('sidebar.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Add Website Logo</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                   
                                    <div class="form-group">
                                        <label>Show on : </label>
                                        <select class="form-select" name="logo_type">
                                            <option value="header">Header</option>
                                            <option value="footer">Footer</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>File <small style="color: orange;" >(Recommended : 300 x 80 pixel for header & 120 x 120 px for footer)</small> </label>
                                        <input type="file" class="form-control" name="logo">
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" name="add_web_logo">Submit</button>
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
</body>
</html>