<?php
require('Dispatcher.php');
require('Controller.php');
require('ModelEntity.php');
require('inputSafetyUtils.php');

function bootstrap() {
    $dispatcher = new SimpleMvc\Dispatcher();

    $dispatcher->LoadSections();
    $dispatcher->Dispatch();
}