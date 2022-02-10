<?php

$tableName = $argv[1];

$controllerName = ucfirst($tableName);
$exampleController = __DIR__ . "/application/controllers/panel/Example.php";
$exampleForm = __DIR__ . "/application/views/back/pages/example/form.php";
$exampleIndex = __DIR__ . "/application/views/back/pages/example/index.php";

if (!file_exists($controllerPath = __DIR__ . "/application/controllers/panel/{$controllerName}.php")) {
    $newController = fopen($controllerPath, 'w+');
    $controllerCreate = fwrite($newController, str_replace(["Example", "{title}"], [$controllerName, $argv[2] ?? $controllerName], file_get_contents($exampleController)));
    if ($controllerCreate) echo "Pomyślnie stworzono kontroler: {$controllerName}.php!\n";
    fclose($newController);
}

if (!is_dir($viewsDirPath = __DIR__ . "/application/views/back/pages/$tableName")) {
    mkdir($viewsDirPath);
    $newFormPath = __DIR__ . "/application/views/back/pages/$tableName/form.php";
    $newIndexPath = __DIR__ . "/application/views/back/pages/$tableName/index.php";

    $newForm = fopen($newFormPath, 'w+');
    $controllerCreate = fwrite($newForm,  file_get_contents($exampleForm));
    if ($controllerCreate) echo "Pomyślnie stworzono widok formularza!\n";
    fclose($newForm);

    $newIndex = fopen($newIndexPath, 'w+');
    $controllerCreate = fwrite($newIndex,  file_get_contents($exampleIndex));
    if ($controllerCreate) echo "Pomyślnie stworzono widok listingu!\n";
    fclose($newIndex);
}