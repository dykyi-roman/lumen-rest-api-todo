<?php

$router->get('/', function () use ($router) {
    return phpinfo();
});
