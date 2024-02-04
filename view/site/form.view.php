<h1>Site Form</h1>

<form action="" method="POST" enctype="multipart/form-data">
    Title: <input type="text" name="title" value="<?=@$site['sitetitle']?>"><br>
    Url: <input type="text" name="url" value="<?=@$site['siteurl']?>"><br>
    link: <input type="text" name="description" value="<?=@$site['sitedescription']?>"><br>
    <p><b>Last Tag:</b> <?=@$site['tagnickname']?> - <?=@$site['tagname']?></p>

    <label for="tag">Select Site Tag:</label>
    <select id="tag" name="tag">
    <?php foreach ($tags as $tag): ?>
            <option value="<?=$tag['id']?>"><?=$tag['nickname']?> - <?=$tag['name']?></option>
    <?php endforeach; ?>
    </select>
    <br><br>
    <p><b>Last Image:</b><img src="<?=URL_BASE.$site['sitelogo']?>"></p>
    <label for="logo">Choose a profile picture:</label>
    <input type="file" id="logo" name="logo" accept="image/png, image/jpeg" />

    

    <br><br>

    <button type="submit">Send</button>
</form>