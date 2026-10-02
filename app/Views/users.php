<!DOCTYPE html>
<html>
<head>
    <title>Users - POS System</title>
</head>
<body>
    <h1>User Accounts</h1>

    <nav>
        <a href="/">Home</a> |
        <a href="/about">About</a> |
        <a href="/customers">Customers</a> |
        <a href="/users">Users</a>
    </nav>

<?php if (session()->get('isLoggedIn')): ?>
    <p>
        Logged in as <?= esc(session()->get('username')) ?> |
        <a href="/logout">Logout</a>
    </p>
<?php endif; ?>
    
<p><a href="/users/new">Add New User</a></p>

    <?php if (session('message')): ?>
        <p style="color: green;"><?= esc(session('message')) ?></p>
    <?php endif; ?>

    <table border="1" cellpadding="8">
        <tr>
            <th>Avatar</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Action</th>
        </tr>

        <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <?php if (! empty($user['avatar'])): ?>
                        <img src="/uploads/<?= esc($user['avatar']) ?>"
                             width="80" height="80" alt="User avatar">
                    <?php else: ?>
                        <img src="/uploads/placeholder.svg"
                             width="80" height="80" alt="No avatar">
                    <?php endif; ?>
                </td>
                <td><?= esc($user['username']) ?></td>
                <td><?= esc($user['full_name']) ?></td>
                <td>
                    <a href="/users/<?= $user['id'] ?>/edit">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>