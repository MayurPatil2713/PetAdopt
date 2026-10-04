<!DOCTYPE html>
<html>
<head>
    <title>Adoption Requests - PetAdopt</title>
</head>
<body>

<h2>Adoption Requests</h2>

<p>
    <a href="<?= base_url('dashboard') ?>">Dashboard</a> |
    <a href="<?= base_url('pets') ?>">My Pets</a> |
    <a href="<?= base_url('logout') ?>">Logout</a>
</p>

<?php if (session()->getFlashdata('success')): ?>
    <p><?= esc(session()->getFlashdata('success')) ?></p>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <p><?= esc(session()->getFlashdata('error')) ?></p>
<?php endif; ?>


<?php if (empty($requests)): ?>

    <p>No adoption requests found.</p>

<?php else: ?>

    <table border="1" cellpadding="8">

        <tr>
            <th>Pet</th>
            <th>Adopter Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Occupation</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php foreach ($requests as $request): ?>

            <tr>

                <td>
                    <?= esc($request['pet_name']) ?>
                </td>

                <td>
                    <?= esc($request['adopter_name']) ?>
                </td>

                <td>
                    <?= esc($request['adopter_email']) ?>
                </td>

                <td>
                    <?= esc($request['phone']) ?>
                </td>

                <td>
                    <?= esc($request['occupation']) ?>
                </td>

                <td>
                    <?= esc($request['reason']) ?>
                </td>

                <td>
                    <?= esc($request['status']) ?>
                </td>

                <td>

                    <?php if ($request['status'] === 'Pending'): ?>

                        <a href="<?= base_url('adoption/approve/' . $request['id']) ?>">
                            Approve
                        </a>

                        <br><br>

                        <a href="<?= base_url('adoption/reject/' . $request['id']) ?>">
                            Reject
                        </a>

                    <?php else: ?>

                        No Action

                    <?php endif; ?>

                </td>

            </tr>

        <?php endforeach; ?>

    </table>

<?php endif; ?>

</body>
</html>