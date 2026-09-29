<?php helper('form'); ?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $customer ? 'Edit Customer' : 'New Customer' ?></title>
</head>
<body>
    <h1><?= $customer ? 'Edit Customer' : 'Add New Customer' ?></h1>

    <nav>
        <a href="/">Home</a> |
        <a href="/about">About</a> |
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
          action="<?= $customer ? '/customers/' . $customer['id'] : '/customers' ?>">

        <?= csrf_field() ?>

        <p>
            <label>Full Name:</label><br>
            <input type="text"
                   name="full_name"
                   value="<?= esc(old('full_name', $customer['full_name'] ?? '')) ?>">
        </p>

        <p>
            <label>Email:</label><br>
            <input type="email"
                   name="email"
                   value="<?= esc(old('email', $customer['email'] ?? '')) ?>">
        </p>

        <p>
            <label>Phone:</label><br>
            <input type="text"
                   name="phone"
                   value="<?= esc(old('phone', $customer['phone'] ?? '')) ?>">
        </p>

        <button type="submit">
            <?= $customer ? 'Update Customer' : 'Add Customer' ?>
        </button>
    </form>
</body>
</html>