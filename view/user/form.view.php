<h1>User Form</h1>

<form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?=@$user['id']?>">
    name: <input type="text" name="name" value="<?=@$user['name']?>">
    email: <input type="text" name="email" value="<?=@$user['email']?>">
    password: <input type="password" name="password" value="<?=@$user['password']?>">
    <br>
    <br>
        <label for="profile"> Upload Image:
        <?php if(!empty($user['profile_img'])){?>
                <img width="50%" src="<?=URL_BASE.$user['profile_img']?>">
        <?php };?>
        </label>
        <input type="file" id="profile" name="profile" accept="image/png"  />
        <br><br>


    <button type="submit">Send</button>
</form>