<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\City;

class LoadCityData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $nyc = new City();
        $nyc->setName('NYC');
        $manager->persist($nyc);

        $bombay = new City();
        $bombay->setName('Bombay');
        $manager->persist($bombay);

        $bta = new City();
        $bta->setName('Bogota');
        $manager->persist($bta);

        $miami = new City();
        $miami->setName('Miami');
        $manager->persist($miami);

        $mexico = new City();
        $mexico->setName('Mexico City');
        $manager->persist($mexico);

        $manager->flush();

        $this->addReference('nyc-city', $nyc);
        $this->addReference('bombay-city', $bombay);
        $this->addReference('bta-city', $bta);
        $this->addReference('miami-city', $miami);
        $this->addReference('mexico-city', $mexico);
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}