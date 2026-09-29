<?php helper('form'); ?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $user ? 'Edit User' : 'New User' ?></title>
</head>
<body>
    <h1><?= $user ? 'Edit User' : 'Add New User' ?></h1>

    <nav>
        <a href="/">Home</a> |
        <a href="/customers">Customers</a> |
        <a href="/users">Users</a>
    </nav>

    <?php $errors = session('errors') ?? []; ?>

    <?php if (! empty($errors)): ?>
        <ul style="color: red;">
            <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post"
          enctype="multipart/form-data"
          action="<?= $user ? '/users/' . $user['id'] : '/users' ?>">

        <?= csrf_field() ?>

        <p>
            <label>Username:</label><br>
            <input type="text" name="username"
                   value="<?= esc(old('username', $user['username'] ?? '')) ?>">
        </p>

        <p>
            <label>Full Name:</label><br>
            <input type="text" name="full_name"
                   value="<?= esc(old('full_name', $user['full_name'] ?? '')) ?>">
        </p>

        <?php if ($user): ?>
            <p>
                <label>Profile Picture (JPG or PNG, maximum 2MB):</label><br>
                <input type="file" name="avatar" accept=".jpg,.jpeg,.png">
            </p>
        <?php endif; ?>

        <button type="submit">
            <?= $user ? 'Update User' : 'Add User' ?>
        </button>
    </form>
</body>
</html>