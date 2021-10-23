<?php

declare(strict_types=1);


namespace App\EventLIstener;


use App\Entity\CelebrityRepresentative;
use App\Entity\Celebrity;
use App\Entity\Log;
use Gedmo\Loggable\Mapping\Event\LoggableAdapter;

class LoggableListener extends \Gedmo\Loggable\LoggableListener
{
    private $loggedCelebrityId = null;

    protected function createLogEntry($action, $object, LoggableAdapter $ea)
    {
        if ($this->loggedCelebrityId !== null) {
            return null;
        }
        if ($object instanceof CelebrityRepresentative) {
            $this->persistCelebrityUpdate($action, $object, $ea);
        }

        return parent::createLogEntry($action, $object, $ea);
    }

    private function persistCelebrityUpdate($action, CelebrityRepresentative $object, LoggableAdapter $ea)
    {
        $celebrity = $object->getCelebrity();
        $log = new Log();
        $log->setUsername($this->username);
        $log->setAction(self::ACTION_UPDATE);
        $log->setLoggedAt();
        $log->setObjectId($celebrity->getId());
        $log->setObjectClass(Celebrity::class);
        $log->setVersion(1);
        $log->setData([
            $object->getType() => [
                $object->getRepresentative()->getName() => $action
            ]
        ]);

        $this->loggedCelebrityId = $celebrity->getId();

        $ea->getObjectManager()->persist($log);
        $ea->getObjectManager()->flush();
        $test = null;
    }

    protected function getLogEntryClass(LoggableAdapter $ea, $class): string
    {
        return Log::class;
    }
}