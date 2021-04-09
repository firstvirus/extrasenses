<?php


namespace controllers;

use models\Extrasense;
use views\Render;

class AppController
{
    public function actionIndex() {
        return Render::render('index');
    }

    public function actionAjaxReady() {
        if (isset($_POST['ready']) && !empty($_POST['ready']) && $_POST['ready'] == true) {
            if (!isset($_SESSION['extrasenses'])) {
                for ($i = 1; $i <= 16; $i++) {
                    $_SESSION['extrasenses'][$i] = new Extrasense;
                }
            }
            foreach ($_SESSION['extrasenses'] as $key => $extrasense) {
                $variants[$key] = $extrasense->getVariant();
            }
            return Render::render('variants', compact('variants'), true);
        }
        return 'error';
    }

    public function actionAjaxGetAnswer() {
        if (isset($_POST['answer']) && !empty($_POST['answer'])) {
            foreach ($_SESSION['extrasenses'] as $key => $extrasense) {
                $extrasenses[$key] = $extrasense->credibility($_POST['answer']);
            }
            $_SESSION['history'][] = $_POST['answer'];
        }
        if (isset($_SESSION['extrasenses']) && !empty($_SESSION['extrasenses'])){
            foreach ($_SESSION['extrasenses'] as $key => $extrasense) {
                $extrasenses[$key] = $extrasense->showCredibility();
            }
            if (isset($_SESSION['history']) && !empty($_SESSION['history'])) {
                $history = $_SESSION['history'];
            } else {
                $history = [];
            }
            return Render::render('results', compact('extrasenses', 'history'), true);
        }
        return 'error';
    }
}
