<?php
/** @var array $games */
?>
<!DOCTYPE html>
<html lang="">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>NHL Games for <?= date('Y-m-d') ?></title>
</head>
<body>

<h1>NHL Games for <?= date('Y-m-d') ?></h1>

<table class="table">
    <thead>
        <tr>
            <th>Away</th>
            <th>Home</th>
            <th>Start</th>
            <th>Venue</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($games as $game): ?>
        <tr>
            <td><?= $game->away ?></td>
            <td><?= $game->home ?></td>
            <td><?= $game->start->format('Y-m-d H:i:s') ?></td>
            <td><?= $game->venue ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
