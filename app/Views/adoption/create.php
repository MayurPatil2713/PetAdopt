<!DOCTYPE html>
<html>
<head>
    <title>Adopt <?= esc($pet['name']) ?> - PetAdopt</title>
</head>
<body>

<h2>Adoption Request</h2>

<p>
    <a href="<?= base_url('pets') ?>">Back to Pets</a>
</p>

<h3><?= esc($pet['name']) ?></h3>

<p>
    Species: <?= esc($pet['species']) ?>
</p>

<p>
    Breed: <?= esc($pet['breed']) ?>
</p>

<p>
    Age: <?= esc($pet['age']) ?>
</p>

<p>
    Gender: <?= esc($pet['gender']) ?>
</p>

<p>
    Vaccination: <?= esc($pet['vaccination_status']) ?>
</p>

<?php if (session()->getFlashdata('errors')): ?>

    <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>


<form
    action="<?= base_url('adoption/store/' . $pet['id']) ?>"
    method="post"
>

    <?= csrf_field() ?>

    <label>Your Name</label><br>
    <input
        type="text"
        name="adopter_name"
        value="<?= esc(old('adopter_name')) ?>"
        required
    >

    <br><br>

    <label>Email</label><br>
    <input
        type="email"
        name="adopter_email"
        value="<?= esc(old('adopter_email')) ?>"
        required
    >

    <br><br>

    <label>Phone</label><br>
    <input
        type="text"
        name="phone"
        value="<?= esc(old('phone')) ?>"
        required
    >

    <br><br>

    <label>Address</label><br>
    <textarea name="address" required><?= esc(old('address')) ?></textarea>

    <br><br>

    <label>Occupation</label><br>
    <input
        type="text"
        name="occupation"
        value="<?= esc(old('occupation')) ?>"
    >

    <br><br>

    <label>Why do you want to adopt this pet?</label><br>
    <textarea name="reason"><?= esc(old('reason')) ?></textarea>

    <br><br>

    <button type="submit">
        Submit Adoption Request
    </button>

</form>

</body>
</html>