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
                                    <div class="form-group">
                                        <label>Label</label>
                                        <input type="text" class="form-control" name="label">
                                    </div>

                                    <div class="form-group">
                                        <label>URL</label>
                                        <input type="text" class="form-control" name="url">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Thumbnail</label>
                                        <input type="file" class="form-control" name="thumbnail">
                                    </div>

                                    <div class="form-group">
                                        <label>Apply on footer</label>
                                        <input type="checkbox" class="form-check-input" name="apply_on_footer">
                                    </div>

                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" name="contact_submit">Submit</button>
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