<?php
/**
 *
 */
namespace src;

require_once __DIR__ . '/../vendor/autoload.php';

use src\View;

$view = new View;

while (true) {
    // メイン画面.
    $command = $view->welcomePage();

    if ($command === 's') {
        $view->cash(-1);
        $view->betOperation();
        $view->bothHand();
        $view->operation();
        $view->result();
        $nextCommand = $view->isNext();
        if ($nextCommand === 'o') {
            continue;
        }
        break;
    } elseif ($command === 'q') {
        break;
    }
}
