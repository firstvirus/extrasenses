<?php

namespace controllers;

use models\Extrasense;
use views\Render;

class AppController
{
    public function actionIndex() {
        return Render::render('index');
    }
    
    public function actionClear() {
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header("Location: /");
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
            if ($_POST['answer'] > 9 && $_POST['answer'] < 100){
                foreach ($_SESSION['extrasenses'] as $key => $extrasense) {
                    $extrasenses[$key] = $extrasense->credibility($_POST['answer']);
                }
                $_SESSION['history'][] = $_POST['answer'];
                if (isset($_SESSION['extrasenses']) && !empty($_SESSION['extrasenses'])){
                    if (isset($_SESSION['history']) && !empty($_SESSION['history'])) {
                        $history[0] = $_SESSION['history'];
                    } else {
                        $history = [];
                    }
                    foreach ($_SESSION['extrasenses'] as $key => $extrasense) {
                        $extrasenses[$key] = $extrasense->showCredibility();
                        $history[$key] = $extrasense->getHistory();
                    }
                    foreach ($history as $keyArray => $vArray) {
                        foreach ($vArray as $keyValue => $value) {
                            $bufHistory[$keyValue][$keyArray] = $value;
                        }
                    }
                    $history = $bufHistory;
                    $bufHistory = null;
                    return Render::render('results', compact('extrasenses', 'history'), true);
                }
            } else { return 'error_1'; }
        }
        return 'error_0';
    }
}
