<?php

namespace App\EventListener;

use App\Entity\AdminUser;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class UserPasswordEncoder
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $this->setPassword($args);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->setPassword($args);
    }

    private function setPassword(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof AdminUser) {
            $password = $entity->getPlainPassword();
            if ($password) {
                $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
                $entity->setPassword($hash);
            }
        }
    }
}