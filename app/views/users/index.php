<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
</head>
<body>
    <?php if (!empty($users)): ?>
        <h1>User List</h1>
        <ul>
            <?php foreach ($users as $user): ?>
                <li>User ID: <?= $user['id'] ?></li>
                <li>Name: <?= $user['name'] ?></li>
                <li>Email: <?= $user['email'] ?></li>
                <a href="user/<?= $user['id'] ?>/edit"><button>Edit</button></a>
                <form action="user/<?=$user['id']?>/delete">
                    <button type="submit">Delete</button>
                </form>
                <br><br>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
    <a href="user/create">Create</a>
</body>
</html>
