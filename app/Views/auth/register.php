<!DOCTYPE html>
<html>
<head>
    <title>Shelter Registration - PetAdopt</title>
</head>
<body>

<h2>Shelter Registration</h2>

<?php if (session()->getFlashdata('errors')): ?>
    <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="<?= base_url('register/save') ?>" method="post">

    <?= csrf_field() ?>

    <label>Name</label><br>
    <input type="text" name="name" value="<?= old('name') ?>">
    <br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="<?= old('email') ?>">
    <br><br>

    <label>Password</label><br>
    <input type="password" name="password">
    <br><br>

    <label>Phone</label><br>
    <input type="text" name="phone" value="<?= old('phone') ?>">
    <br><br>

    <label>Address</label><br>
    <textarea name="address"><?= old('address') ?></textarea>
    <br><br>

    <button type="submit">Register</button>

</form>

<p>
    Already registered?
    <a href="<?= base_url('login') ?>">Login</a>
</p>

</body>
</html>