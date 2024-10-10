<?php foreach ($technicians as $technician) : ?>
    <div>
        <h2><?= $technician->firstname ?></h2>
        <p><?= $technician->lastname ?></p>
    </div>
<?php endforeach; ?>