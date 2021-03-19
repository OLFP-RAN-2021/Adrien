<?php
namespace app\controllers\API;

use app\forms\contact;
use app\http\Response;

$form = new contact();
if ($form->response !== null)
{
    $response = new Response('json');
    echo $response->container->truc = "machin";
}