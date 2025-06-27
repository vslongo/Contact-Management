<?php

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

try {
    $response = $kernel->handle(
        $request = Request::capture()
    )->send();
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage();
    exit;
}

$kernel->terminate($request, $response);
