<?php

namespace App\Command;

use App\Entity\Ent;
use App\Util\ConsulFetcher;
use Doctrine\ORM\EntityManagerInterface;
use SensioLabs\Consul\ConsulResponse;
use SensioLabs\Consul\ServiceFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected static $defaultName = 'app:test';
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var ConsulFetcher
     */
    private $fetcher;
    private $str;

    public function __construct(EntityManagerInterface $em, ConsulFetcher $fetcher, $str)
    {
        parent::__construct();
        $this->em = $em;
        $this->fetcher = $fetcher;
        $this->str = $str;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {


        $output->writeln(
            $this->fetcher->fetch('something/test')
        );

        $output->writeln('asd');return;

        $coll = $this->em->createQueryBuilder()->select()->from(Ent::class, 'e')->getQuery();

        /**
         * @var Ent $i
         */
        foreach($coll->iterate() as $i){
            $output->writeln($i->getField1());
        }

        $result = [];


//        $test = new Struct();
//        $test->field1 = 'asd';
//        $test->field2 = 123;
//
//        $target = new Ent();
//
//        $config        = new Configuration(Ent::class);
//        $hydratorClass = $config->createFactory()->getHydratorClass();
//        /**
//         * @var HydratorInterface $hydrator
//         */
//        $hydrator      = new $hydratorClass();
//
//
//        $result = $hydrator->hydrate((array)$test, $target);

        dump($result);

    }
}
