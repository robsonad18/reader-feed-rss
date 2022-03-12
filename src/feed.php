<?php

use App\Feed\TecMundo;

$obTecMundo = new TecMundo();

$lastUpdate = date("d/m/Y à\s H:i:s", strtotime($obTecMundo->getLastUpdate()));


$items = "";
foreach ($obTecMundo->getItems() as $item) {
    // DUBLIN CORE
    $dc = $item->children("http://purl.org/dc/elements/1.1/");

    $date = date("d/m/Y à\s H:i:s", strtotime($item->pubDate));
    $image = $item->enclosure->attributes()->url;
    $items .= '<div class="col">
        <div class="card text-dark h-100">
        <div class="card-body">
        <span class="badge bg-primary">'.$item->category.'</span>
        <h5 class="card-title">' . $item->title . '</h5>
                <img src="' . $image . '" class="card-img-top" alt="' . $item->title . '">
                <p class="card-text">' . $item->description . '</p>
            </div>
        <div class="card-footer">
            <small class="text-muted">Publicado em ' .$date.' por '.$dc->creator.'</small>
        </div>
        </div>
    </div>';
}

?>

<div class="text-center">
    <img src="<?= $obTecMundo->getLogo() ?>" class="mb-3" alt="<?= $obTecMundo->getTitle() ?>">

    <h1 class="mb-0"><?= $obTecMundo->getTitle() ?></h1>
    <p class="mb-0"><?= $obTecMundo->getDescription() ?></p>
    <p class="text-muted mb-4"><?= $lastUpdate  ?></p>
</div>

<div class="row row-cols-1 row-cols-md-2 g-4">
    <?= $items ?>
</div>