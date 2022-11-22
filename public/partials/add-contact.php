<form action="<?php echo site_url(); ?>/wp-admin/admin-post.php" method="post" enctype="multipart/form-data">
   
    <lable>Name:</lable>
    <input type="text" name="moviename" value="<?php if (isset($post->post_title)) {echo $post->post_title;}?>">
    <lable>Email:</lable>
    <input type="text" name="email" value="<?php if (isset($post->post_title)) {echo $post->post_title;}?>">
    <input type="submit" value="<?php echo $btnvalue ?>" name="submit" class="btn btn-info">
</form>