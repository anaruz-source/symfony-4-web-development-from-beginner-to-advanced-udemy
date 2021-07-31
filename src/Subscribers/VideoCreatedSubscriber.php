<?php

namespace App\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\TerminateEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class VideoCreatedSubscriber implements EventSubscriberInterface
{
    public function onVideoCreatedEvent($event)
    {
        dump($event);
        dump('Subscriber called!');
    }

    public function onKernelTerminate1(TerminateEvent $event)
    {
        return; // prevent dump to interere with form data
        // dump('Kernel event catched by Subscriber <br> onKernelTerminate1 event executed');
    }

    public function onKernelTerminate2(TerminateEvent $event)
    {
        return; // prevent dump to interere with form data
        //dump('Kernel event catched by Subscriber <br> onKernelTerminate2 event executed');
    }

    public static function getSubscribedEvents()
    {
        return [
            'video.created.event' => 'onVideoCreatedEvent',
            KernelEvents::TERMINATE => [
                ['onKernelTerminate2', 1],
                ['onKernelTerminate1', 2], ],
        ];
    }
}
