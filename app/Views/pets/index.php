<!DOCTYPE html>
<html>
<head>
    <title>My Pets - PetAdopt</title>
</head>
<body>

<h2>My Pets</h2>

<p>
    <a href="<?= base_url('dashboard') ?>">Dashboard</a> |
    <a href="<?= base_url('pets/create') ?>">Add Pet</a> |
    <a href="<?= base_url('logout') ?>">Logout</a>
</p>

<?php if (session()->getFlashdata('success')): ?>
    <p>
        <?= esc(session()->getFlashdata('success')) ?>
    </p>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <p>
        <?= esc(session()->getFlashdata('error')) ?>
    </p>
<?php endif; ?>


<?php if (empty($pets)): ?>

    <p>You have not added any pets yet.</p>

<?php else: ?>

    <table border="1" cellpadding="8">

        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Species</th>
            <th>Breed</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Vaccination</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($pets as $pet): ?>

            <tr>

                <td>
                    <?php if (!empty($pet['image'])): ?>

                        <img
                            src="<?= base_url('uploads/pets/' . $pet['image']) ?>"
                            width="100"
                            height="100"
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
                    <?= esc($pet['status']) ?>
                </td>

                <td>

                    <a href="<?= base_url('pets/edit/' . $pet['id']) ?>">
                        Edit
                    </a>

                    <br><br>

                    <?php if ($pet['status'] === 'Available'): ?>

                        <br><br>

                        <a href="<?= base_url('adoption/create/' . $pet['id']) ?>">
                            Adopt
                        </a>

                    <?php endif; ?>

                    <form
                        action="<?= base_url('pets/delete/' . $pet['id']) ?>"
                        method="post"
                        style="display:inline"
                        onsubmit="return confirm('Delete this pet?');"
                    >

                        <?= csrf_field() ?>

                        <button type="submit">
                            Delete
                        </button>

                    </form>

                </td>

            </tr>

        <?php endforeach; ?>

    </table>

<?php endif; ?>

</body>
</html>