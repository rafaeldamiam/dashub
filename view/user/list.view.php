<h1>List All Users</h1>

<table class="table">
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>show</th>
            <th>edit</th>
            <th>delete</th>
        </tr>
    </thead>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?=$user['id']?></td>
        <td><?=$user['name']?></td>
        <td><?=$user['email']?></td>
        <td><a href="<?=URL_BASE.'user/show/'.$user['id']?>" class="btn btn-secondary">show</a></td>
        <td><a href="<?=URL_BASE.'user/edit/'.$user['id']?>" class="btn btn-info">edit</a></td>
        <td><a href="<?=URL_BASE.'user/delete/'.$user['id']?>" class="btn btn-danger">del</a></td>
    </tr>
    <?php endforeach; ?>
</table>

<a href="<?=URL_BASE.'user/add/'?>" class="btn btn-primary">Add New User</a>

