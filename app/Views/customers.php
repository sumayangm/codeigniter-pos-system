<!DOCTYPE html>
<html>
<head>
    <title>Customers - POS System</title>
</head>
<body>
    <h1>Customer Accounts</h1>

    <nav>
        <a href="/">Home</a> |
        <a href="/about">About</a> |
        <a href="/customers">Customers</a> |
        <a href="/users">Users</a>
    </nav>

    <p><a href="/customers/new">Add New Customer</a></p>

    <?php if (session('message')): ?>
        <p style="color: green;"><?= esc(session('message')) ?></p>
    <?php endif; ?>

    <table border="1" cellpadding="8">
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>

        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= esc($customer['full_name']) ?></td>
                <td><?= esc($customer['email']) ?></td>
                <td><?= esc($customer['phone']) ?></td>
                <td>
                    <a href="/customers/<?= $customer['id'] ?>/edit">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>