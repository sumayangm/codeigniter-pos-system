<?php helper('form'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - POS System</title>
</head>
<body>
    <h1>POS System Login</h1>

    <?php if (session('message')): ?>
        <p style="color: green;"><?= esc(session('message')) ?></p>
    <?php endif; ?>

    <?php if (session('error')): ?>
        <p style="color: red;"><?= esc(session('error')) ?></p>
    <?php endif; ?>

    <?php $errors = session('errors') ?? []; ?>

    <?php if (! empty($errors)): ?>
        <ul style="color: red;">
            <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="/login">
        <?= csrf_field() ?>

        <p>
            <label>Username:</label><br>
            <input type="text" name="username" value="<?= esc(old('username')) ?>">
        </p>

        <p>
            <label>Password:</label><br>
            <input type="password" name="password">
        </p>

        <button type="submit">Login</button>
    </form>
</body>
</html>