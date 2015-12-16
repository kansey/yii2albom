<?php

/* @var $this yii\web\View */
use app\models\User;
use app\models\Albom;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
$this->registerCssFile('css/bootstrap.css');
$this->registerCssFile('css/bootstrap-responsive.css');
$this->title = 'My Yii Application';

$user = Albom::getUser();


?>
<div class="site-index">
    <div class="jumbotron">
     <h1>Simple Gallery</h1>
     <p class="lead">A simple application created with the framework Yii2. Additional features will be added later.</p>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2>Profile User</h2>
                <div class="row-fluid">
                <div class="span8">
                <h6>Username: <?= $user['login']?></h3>
                <h6>Email: <?= $user['email']?> </h6>
            </div>
        </div>
               
        </div>
            <div class="col-lg-4">
                <h2>Description</h2>
                <p>It provides the ability for registered users to add and store images</p>
            </div>
            <div class="col-lg-4">
                <h2>Components</h2>
                <ul>
                    <li>
                        <p>Widget: 2amigos/yii2-gallery-widget</p>
                        <p><a class="btn btn-lg btn-success" href="https://github.com/2amigos/yii2-gallery-widget">Documantation&raquo;</a></p>
                    </li>
                    <li>
                        <p>Widget: zyx/widget-imagex</p>
                        <p><a class="btn btn-lg btn-success" href="https://github.com/SDKiller/zyx-widget-imagex">Documantation&raquo;</a></p>
                    </li>
                </ul>    
            

            </div>
        </div>

    </div>
</div>