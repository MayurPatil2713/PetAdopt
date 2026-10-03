<!DOCTYPE html>
<html>
<head>
    <title>Shelter Dashboard - PetAdopt</title>
</head>
<body>

<h2>Welcome, <?= esc(session()->get('shelter_name')) ?></h2>

<p>
    <a href="<?= base_url('pets') ?>">My Pets</a> |
    <a href="<?= base_url('pets/create') ?>">Add Pet</a> |
    <a href="<?= base_url('logout') ?>">Logout</a>
</p>

<hr>

<h3>Dashboard Summary</h3>

<p>Total Pets: <?= esc($totalPets) ?></p>

<p>Available Pets: <?= esc($availablePets) ?></p>

<p>Adopted Pets: <?= esc($adoptedPets) ?></p>

<p>Pending Adoption Requests: <?= esc($pendingRequests) ?></p>

</body>
</html>