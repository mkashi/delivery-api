<?php

namespace Delivery\ApiBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class PayloadRequestTransformer
 */
class PayloadRequestTransformer implements EventSubscriberInterface
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

        if ('json' === $request->getContentType() && 0 === strpos($request->getPathInfo(), '/api')) {
            $json = json_decode($request->getContent(), true);
            $json = array_filter($json);
            if ($json) {
                $posted = $request->request->all();
                $posted = array_merge($posted, $json);

                $request->request->replace($posted);
            }
        }
    }

}
