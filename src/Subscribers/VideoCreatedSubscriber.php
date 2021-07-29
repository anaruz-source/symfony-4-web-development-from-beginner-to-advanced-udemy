<?php

namespace App\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class VideoCreatedSubscriber implements EventSubscriberInterface
{
    public function onVideoCreatedEvent($event)
    {
        dump($event);
        dump('Subscriber called!');
    }

    public function onKernelResponse1(ResponseEvent $event)
    {
        $response = new Response('Kernel event catched by Subscriber <br> onKernelEvent1 event executed');
        dump('onKernelResponse1');
        $event->setResponse($response);
    }

    public function onKernelResponse2(ResponseEvent $event)
    {
        $response = new Response('Kernel event catched by Subscriber <br> onKernelEvent2 event executed');
        dump('onKernelResponse2');
        $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
        return [
            'video.created.event' => 'onVideoCreatedEvent',
            KernelEvents::RESPONSE => [
                ['onKernelResponse2', 1],
                ['onKernelResponse1', 2], ],
        ];
    }
}
