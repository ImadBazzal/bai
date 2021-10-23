<?php

declare(strict_types=1);


namespace App\Tests;


use App\Entity\Agent;
use App\Entity\Celebrity;
use App\Entity\Email;
use App\Entity\Manager;
use App\Entity\Publicist;
use App\Entity\Representative;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Gedmo\Loggable\Entity\LogEntry;
use Gedmo\Loggable\Entity\Repository\LogEntryRepository;
use Gedmo\Loggable\LoggableListener;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LoggingTest extends KernelTestCase
{
    use RefreshDatabaseTrait;

    /**
     * @var ObjectRepository|LogEntryRepository
     */
    private ObjectRepository $logRepository;
    private ?EntityManagerInterface $em;

    protected function setUp(): void
    {
        parent::setUp();
        static::bootKernel();

        $this->em            = self::getContainer()->get(EntityManagerInterface::class);
        $this->logRepository = $this->em->getRepository(LogEntry::class);
    }

    /**
     * @dataProvider entityProvider
     */
    public function testCreateAndUpdateLogs(callable $entityProvider, array $expectedLogActions)
    {
        $entity = $entityProvider($this->em);

        $logs = $this->logRepository->getLogEntries($entity);

        $this->assertCount(count($expectedLogActions), $logs);

        foreach ($expectedLogActions as $i => $action) {
            $this->assertEquals($action, $logs[$i]->getAction());
        }
    }

    public function entityProvider(): iterable
    {
        yield 'Celebrity' => [
            function (EntityManagerInterface $em) {
                /** @var Celebrity $entity */
                $entity = $em->find(Celebrity::class, 1);
                $entity->setName('Updated name');
                $entity->setBio('Updated bio');
                $entity->setBirthday(new DateTimeImmutable());
                $em->persist($entity);
                $em->flush();

                return $entity;
            },
            [LoggableListener::ACTION_UPDATE, LoggableListener::ACTION_CREATE],
        ];
        yield 'Email' => [
            function (EntityManagerInterface $em) {
                /** @var Email $entity */
                $entity = $em->find(Email::class, 1);
                $entity->setEmail('updated@email.com');
                $em->persist($entity);
                $em->flush();

                return $entity;
            },
            [LoggableListener::ACTION_UPDATE, LoggableListener::ACTION_CREATE],
        ];
        yield 'Representative' => [
            function (EntityManagerInterface $em) {
                /** @var Representative $entity */
                $entity = $em->find(Representative::class, 1);
                $entity->setName('updated name');
                $entity->setName('updated company');
                $em->persist($entity);
                $em->flush();

                return $entity;
            },
            [LoggableListener::ACTION_UPDATE, LoggableListener::ACTION_CREATE],
        ];
    }
}