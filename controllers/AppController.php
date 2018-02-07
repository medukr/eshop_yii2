<?php
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 30.01.18
 * Time: 12:35
 */

namespace app\controllers;


use yii\web\Controller;

class AppController extends Controller {

    protected function setMeta($title = null, $keywords = null, $description = null){
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
    }
}