<?php

$items = [
    ['label' => 'Главная', 'url' => '/'],
    ['label' => 'AJAX', 'url' => '/ajax.php'],
    ['label' => 'Каталог', 'url' => '/shop/catalog.php']
];

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand d-flex align-items-center" href="/">
        <img src="/img/logo.png" alt="<?= $config['name'] ?>" height="30" class="mr-2">
        <?= $config['name'] ?>
    </a>
    <div class="collapse navbar-collapse navbar-right" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <?php foreach ($items as $link) : ?>
								<li class="nav-item">
										<a class="nav-link" href="<?= $link['url'] ?>"><?= $link['label'] ?></a>
								</li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>