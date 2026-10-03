<!DOCTYPE html>
<html>
<head>
    <title>Add Pet - PetAdopt</title>
</head>
<body>

<h2>Add Pet</h2>

<p>
    <a href="<?= base_url('pets') ?>">Back to My Pets</a>
</p>

<?php if (session()->getFlashdata('errors')): ?>
    <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="<?= base_url('pets/store') ?>" method="post" enctype="multipart/form-data">

    <?= csrf_field() ?>

    <label>Name</label><br>
    <input
        type="text"
        name="name"
        value="<?= esc(old('name')) ?>"
        required
    >
    <br><br>

    <label>Species</label><br>
    <input
        type="text"
        name="species"
        value="<?= esc(old('species')) ?>"
        required
    >
    <br><br>

    <label>Breed</label><br>
    <input
        type="text"
        name="breed"
        value="<?= esc(old('breed')) ?>"
        required
    >
    <br><br>

    <label>Age</label><br>
    <input
        type="number"
        name="age"
        min="0"
        value="<?= esc(old('age')) ?>"
        required
    >
    <br><br>

    <label>Gender</label><br>
    <select name="gender" required>
        <option value="">Select gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>
    <br><br>

    <label>Vaccination Status</label><br>
    <input
        type="text"
        name="vaccination_status"
        value="<?= esc(old('vaccination_status')) ?>"
        required
    >
    <br><br>

    <label>Description</label><br>
    <textarea name="description"><?= esc(old('description')) ?></textarea>
    <br><br>

    <label>Pet Image</label><br>
    <input
        type="file"
        name="image"
        accept="image/*"
    >
    <br><br>

    <button type="submit">Add Pet</button>

</form>

</body>
</html>