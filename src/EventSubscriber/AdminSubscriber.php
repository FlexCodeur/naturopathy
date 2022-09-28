<?php

namespace App\EventSubscriber;

use App\Model\TimeInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class AdminSubscriber implements EventSubscriberInterface
{

    private $security;

    public function __construct( Security $security)
    {
        $this->security = $security;
    }

    #[ArrayShape([BeforeEntityPersistedEvent::class => "string[]", BeforeEntityUpdatedEvent::class => "string[]"])]
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['setEntityCreatedAt'],
            BeforeEntityUpdatedEvent::class => ['setEntityUpdatedAt']
        ];
    }

    public function setEntityCreatedAt(BeforeEntityPersistedEvent $event) : void
    {
        $entity = $event->getEntityInstance();

        if(!$entity instanceof TimeInterface) {
            return;
        }

        $user = $this->security->getUser();

        $entity->setUser($user);
        $entity->setCreatedAt(new \DateTime('now'));
    }

    public function setEntityUpdatedAt(BeforeEntityUpdatedEvent $event) : void
    {
        $entity = $event->getEntityInstance();

        if(!$entity instanceof TimeInterface) {
            return;
        }

        $entity->setUpdatedAt(new \DateTime('now'));
    }
}

