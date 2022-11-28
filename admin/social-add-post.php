<?php 
    include('sidebar.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Add Social News</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label>Type</label>
                                        <input type="text" class="form-control" name="news_type" value="social" readonly>
                                    </div>
                                    

                                    <div class="form-group">
                                        <label for="">Categories</label>
                                        <select name="category" class="form-select">
                                            <option value="national">National</option>
                                            <option value="international">International</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Thumbnail <small style="color: orange;" >(Recommended : 350 x 200 pixel)</small></label>
                                        <input type="file" class="form-control" name="thumbnail">
                                    </div>

                                    <div class="form-group">
                                        <label>Banner <small style="color: orange;" >(Recommended : 730 x 415 pixel)</small> </label>
                                        <input type="file" class="form-control" name="banner">
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success" name="social_publish">Publish</button>
                                        <a href="social-view-post.php" class="btn btn-primary">View Post</a>
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