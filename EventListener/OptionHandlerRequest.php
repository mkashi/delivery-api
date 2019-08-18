<?php

namespace Delivery\ApiBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class OptionHandlerRequest
 */
class OptionHandlerRequest implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::EXCEPTION  => [
                array('onKernelRequest', 255),
            ]
        );
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();
        $method  = $request->getRealMethod();

        $method = strtolower($method);

        if ('options' == $method) {
            $response = new Response();
            $response->headers->set('Access-Control-Max-Age', 600);
            $event->setResponse($response);
            $event->stopPropagation();
        }
    }

}
