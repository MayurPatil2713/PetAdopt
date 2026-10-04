<!DOCTYPE html>
<html>
<head>
    <title><?= esc($pet['name']) ?> - PetAdopt</title>
</head>
<body>

<h2>Pet Details</h2>

<p>
    <a href="<?= base_url('pets/browse') ?>">Back to Available Pets</a>
</p>

<hr>

<h3><?= esc($pet['name']) ?></h3>

<?php if (!empty($pet['image'])): ?>

    <p>
        <img
            src="<?= base_url('uploads/pets/' . $pet['image']) ?>"
            width="300"
            height="300"
            alt="<?= esc($pet['name']) ?>"
        >
    </p>

<?php else: ?>

    <p>No image available.</p>

<?php endif; ?>

<table border="1" cellpadding="10">

    <tr>
        <th>Species</th>
        <td><?= esc($pet['species']) ?></td>
    </tr>

    <tr>
        <th>Breed</th>
        <td><?= esc($pet['breed']) ?></td>
    </tr>

    <tr>
        <th>Age</th>
        <td><?= esc($pet['age']) ?></td>
    </tr>

    <tr>
        <th>Gender</th>
        <td><?= esc($pet['gender']) ?></td>
    </tr>

    <tr>
        <th>Vaccination Status</th>
        <td><?= esc($pet['vaccination_status']) ?></td>
    </tr>

    <tr>
        <th>Description</th>
        <td><?= esc($pet['description']) ?></td>
    </tr>

    <tr>
        <th>Status</th>
        <td><?= esc($pet['status']) ?></td>
    </tr>

</table>

<br>

<?php if ($pet['status'] === 'Available'): ?>

    <a href="<?= base_url('adoption/create/' . $pet['id']) ?>">
        <button type="button">Adopt This Pet</button>
    </a>

<?php endif; ?>

</body>
</html>