<?php

$routes = [
    [
        'path' => 'contact-us',
        'controller' => 'ContactController',
        'action' => 'ViewAction'
    ],
    [
        'path' => 'contact-us/submit',
        'controller' => 'ContactController',
        'action' => 'SubmitAction'
    ]
];