<?php
require('Dispatcher.php');
require('Controller.php');

function bootstrap() {
    $dispatcher = new SimpleMvc\Dispatcher();

    $dispatcher->LoadSections();
    $dispatcher->Dispatch();
}