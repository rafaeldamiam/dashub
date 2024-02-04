<h1>List All sites</h1>

<table class="table">
    <thead>
        <tr>
            <th>image</th>
            <th>name</th>
            <th>description</th>
            <th>show</th>
            <th>edit</th>
            <th>delete</th>
        </tr>
    </thead>
    <?php foreach ($sites as $site): ?>
    <tr>
        <td><a target="_blank" href="<?=$site['url']?>"><img width="20%" src="<?=URL_BASE.$site['logo']?>"></a></td>
        <td><?=$site['title']?></td>
        <td><?=$site['description']?></td>
        <td><a href="<?=URL_BASE.'site/show/'.$site['id']?>" class="btn btn-secondary">show</a></td>
        <td><a href="<?=URL_BASE.'site/edit/'.$site['id']?>" class="btn btn-info">edit</a></td>
        <td><a href="<?=URL_BASE.'site/delete/'.$site['id']?>" class="btn btn-danger">del</a></td>
    </tr>
    <?php endforeach; ?>
</table>

<a href="<?=URL_BASE.'site/add/'?>" class="btn btn-primary">Add New site</a>

