<!DOCTYPE html>
<html>
<head>
    <title>Available Pets - PetAdopt</title>
</head>
<body>

<h2>Available Pets</h2>

<p>
    <a href="<?= base_url('/') ?>">Home</a> |
    <a href="<?= base_url('login') ?>">Shelter Login</a>
</p>

<hr>

<?php if (session()->getFlashdata('error')): ?>
    <p>
        <?= esc(session()->getFlashdata('error')) ?>
    </p>
<?php endif; ?>

<?php if (empty($pets)): ?>

    <p>No pets are currently available for adoption.</p>

<?php else: ?>

    <table border="1" cellpadding="10">

        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Species</th>
            <th>Breed</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Vaccination</th>
            <th>Action</th>
        </tr>

        <?php foreach ($pets as $pet): ?>

            <tr>

                <td>
                    <?php if (!empty($pet['image'])): ?>

                        <img
                            src="<?= base_url('uploads/pets/' . $pet['image']) ?>"
                            width="120"
                            height="120"
                            alt="<?= esc($pet['name']) ?>"
                        >

                    <?php else: ?>

                        No Image

                    <?php endif; ?>
                </td>

                <td>
                    <?= esc($pet['name']) ?>
                </td>

                <td>
                    <?= esc($pet['species']) ?>
                </td>

                <td>
                    <?= esc($pet['breed']) ?>
                </td>

                <td>
                    <?= esc($pet['age']) ?>
                </td>

                <td>
                    <?= esc($pet['gender']) ?>
                </td>

                <td>
                    <?= esc($pet['vaccination_status']) ?>
                </td>

                <td>
                    <a href="<?= base_url('pets/details/' . $pet['id']) ?>">
                        View Details
                    </a>
                </td>

            </tr>

        <?php endforeach; ?>

    </table>

<?php endif; ?>

</body>
</html>