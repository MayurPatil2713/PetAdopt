<!DOCTYPE html>
<html>
<head>
    <title>Shelter Login - PetAdopt</title>
</head>
<body>

<h2>Shelter Login</h2>

<?php if (session()->getFlashdata('success')): ?>
    <p><?= esc(session()->getFlashdata('success')) ?></p>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <p><?= esc(session()->getFlashdata('error')) ?></p>
<?php endif; ?>

<form action="<?= base_url('login/check') ?>" method="post">

    <?= csrf_field() ?>

    <label>Email</label><br>
    <input type="email" name="email" value="<?= old('email') ?>" required>
    <br><br>

    <label>Password</label><br>
    <input type="password" name="password" required>
    <br><br>

    <button type="submit">Login</button>

</form>

<p>
    Don't have an account?
    <a href="<?= base_url('register') ?>">Register</a>
</p>

</body>
</html>