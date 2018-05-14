<?php

namespace sebi\ball_project;

use sebi\ball\basketball;
use sebi\ball\volleyball;
use sebi\ball\flummi;

require_once "vendor/autoload.php";


$ball1 = new basketball("Basketball", 30, "Leder");
$ball2 = new volleyball("Volleyball", 30, "Plastik");
$ball3 = new flummi("Flummi", 30, "Gummi");
$ball4 = new basketball("Basketball", 30, "Leder");
$ball5 = new volleyball("Volleyball", 30, "Leder");
$ball6 = new flummi("Flummi", 30, "Gummi");

$values = [
    'ball1' => $ball1,
    'ball2' => $ball2,
    'ball3' => $ball3,
    'ball4' => $ball4,
    'ball5' => $ball5,
    'ball6' => $ball6
];


function outputJSON($balls): string
{
    $json = '[ ';
    foreach ($balls as $item) {
        $json = $json . '{ "name": "' . $item->getName() . '", "diameter": "' . $item->getDurchmesser() . '", "material": "' . $item->getMaterial() . '", "volume": "' . $item->getVolumen() . '"}, ';
    }

    return substr($json, 0, strlen($json) - 2) . ' ]';
}

if (isset($_GET['material'])) {
    $material = $_GET['material'];
} else {
    $material = "";
}

if (isset($_GET['format'])) {
    if (strcasecmp($_GET['format'], "json") == 0) {
        header("Content-type:application/json");
        echo outputJSON(sortOutput($values, $material));
    } else {
        echo outputHTML(sortOutput($values, $material));
    }
} else {
    echo outputHTML(sortOutput($values, $material));
}

function sortOutput($values, string $material): array
{
    if ($material == "") {
        return $values;
    }

    $newValues = array();
    $key = 1;

    foreach ($values as $item) {
        if (strcasecmp($item->getMaterial(), $material) == 0) {
            $newValues["ball" . $key] = $item;
            $key++;
        }
    }

    return $newValues;
}


function outputHTML($balls): string
{
// Initializing the View: rendering in Fluid takes place through a View instance
// which contains a RenderingContext that in turn contains things like definitions
// of template paths, instances of variable containers and similar.
    $view = new \TYPO3Fluid\Fluid\View\TemplateView();

// TemplatePaths object: a subclass can be used if custom resolving is wanted.
    $paths = $view->getTemplatePaths();

// Assigning the template path and filename to be rendered. Doing this overrides
// resolving normally done by the TemplatePaths and directly renders this file.
    $paths->setTemplatePathAndFilename(__DIR__ . '/Template/ausgabe.html');

// In this example we assign all our variables in one array. Alternative is
// to repeatedly call $view->assign('name', 'value').
    $view->assignMultiple($balls);

// Rendering the View: plain old rendering of single file, no bells and whistles.
    return $view->render();
}