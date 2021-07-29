<?php

namespace App\Services;

/* this cousre uses FilterResponseEvent but since Symfony 4.3, use ResponseEvent instead
*  Deprecated since Symfony 4.3: GetResponseEvent | FilterResponseEvent
*  source: https://www.drupal.org/project/drupal/issues/3130651
*/
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class KernelResponseListener
{
    public function onKernelResponse(ResponseEvent $e)
    {
        //Drupa will be returned to user no matter what response is returned by controllers!
        $response = new Response('Drupa');
        $e->setResponse($response);
    }
}
