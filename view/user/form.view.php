<h1>User Form</h1>

<form action="" method="POST">
    name: <input type="text" name="name" value="<?=@$user['name']?>">
    email: <input type="text" name="email" value="<?=@$user['email']?>">
    password: <input type="password" name="password" value="<?=@$user['password']?>">
    <button type="submit">Send</button>
</form>