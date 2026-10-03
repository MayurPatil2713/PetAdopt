<!DOCTYPE html>
<html>
<head>
    <title>Edit Pet - PetAdopt</title>
</head>
<body>

<h2>Edit Pet</h2>

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


<form
    action="<?= base_url('pets/update/' . $pet['id']) ?>"
    method="post"
    enctype="multipart/form-data"
>

    <?= csrf_field() ?>


    <label>Name</label><br>

    <input
        type="text"
        name="name"
        value="<?= esc(old('name', $pet['name'])) ?>"
        required
    >

    <br><br>


    <label>Species</label><br>

    <input
        type="text"
        name="species"
        value="<?= esc(old('species', $pet['species'])) ?>"
        required
    >

    <br><br>


    <label>Breed</label><br>

    <input
        type="text"
        name="breed"
        value="<?= esc(old('breed', $pet['breed'])) ?>"
        required
    >

    <br><br>


    <label>Age</label><br>

    <input
        type="number"
        name="age"
        min="0"
        value="<?= esc(old('age', $pet['age'])) ?>"
        required
    >

    <br><br>


    <label>Gender</label><br>

    <select name="gender" required>

        <option value="">Select gender</option>

        <option
            value="Male"
            <?= old('gender', $pet['gender']) === 'Male' ? 'selected' : '' ?>
        >
            Male
        </option>

        <option
            value="Female"
            <?= old('gender', $pet['gender']) === 'Female' ? 'selected' : '' ?>
        >
            Female
        </option>

    </select>

    <br><br>


    <label>Vaccination Status</label><br>

    <input
        type="text"
        name="vaccination_status"
        value="<?= esc(old('vaccination_status', $pet['vaccination_status'])) ?>"
        required
    >

    <br><br>


    <label>Description</label><br>

    <textarea name="description"><?= esc(old('description', $pet['description'])) ?></textarea>

    <br><br>


    <label>Current Image</label><br>

    <?php if (!empty($pet['image'])): ?>

        <img
            src="<?= base_url('uploads/pets/' . $pet['image']) ?>"
            width="150"
            height="150"
            alt="<?= esc($pet['name']) ?>"
        >

    <?php else: ?>

        <p>No image uploaded.</p>

    <?php endif; ?>

    <br><br>


    <label>Replace Image</label><br>

    <input
        type="file"
        name="image"
        accept="image/*"
    >

    <br><br>


    <button type="submit">
        Update Pet
    </button>

</form>

</body>
</html>