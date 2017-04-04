
<?php

$data['products'] = $products;

//html текст
$view = ModelCatalog::ViewProduct($data['products']);
echo $view;
?>