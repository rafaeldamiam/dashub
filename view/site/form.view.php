<h1>site Form</h1>

<form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?=@$site['id']?>">
    title: <input type="text" name="title" value="<?=@$site['title']?>">
    url: <input type="text" name="url" value="<?=@$site['url']?>">
    description: <textarea type="text" name="description"><?=@$site['description']?></textarea>
    <br>
    <br>
        <label for="profile"> Upload Image:
        <?php if(!empty($site['logo'])){?>
                <img width="50%" src="<?=URL_BASE.$site['logo']?>">
        <?php };?>
        </label>
        <input type="file" id="profile" name="profile" accept="image/png"  />
        <br><br>


    <button type="submit">Send</button>
</form>