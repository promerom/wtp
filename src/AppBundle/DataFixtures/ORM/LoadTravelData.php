<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Travel;

class LoadTravelData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $nyc_bombay = new Travel();
        $nyc_bombay->setCity1($this->getReference('nyc-city'));
        $nyc_bombay->setCity2($this->getReference('bombay-city'));
        $nyc_bombay->setCost(15);
        $manager->persist($nyc_bombay);

        $nyc_bta = new Travel();
        $nyc_bta->setCity1($this->getReference('nyc-city'));
        $nyc_bta->setCity2($this->getReference('bta-city'));
        $nyc_bta->setCost(5);
        $manager->persist($nyc_bta);

        $nyc_miami = new Travel();
        $nyc_miami->setCity1($this->getReference('nyc-city'));
        $nyc_miami->setCity2($this->getReference('miami-city'));
        $nyc_miami->setCost(3);
        $manager->persist($nyc_miami);

        $nyc_mexico = new Travel();
        $nyc_mexico->setCity1($this->getReference('nyc-city'));
        $nyc_mexico->setCity2($this->getReference('mexico-city'));
        $nyc_mexico->setCost(6);
        $manager->persist($nyc_mexico);

        $bombay_bta = new Travel();
        $bombay_bta->setCity1($this->getReference('bombay-city'));
        $bombay_bta->setCity2($this->getReference('bta-city'));
        $bombay_bta->setCost(17);
        $manager->persist($bombay_bta);

        $bombay_miami = new Travel();
        $bombay_miami->setCity1($this->getReference('bombay-city'));
        $bombay_miami->setCity2($this->getReference('miami-city'));
        $bombay_miami->setCost(15);
        $manager->persist($bombay_miami);

        $bombay_mexico = new Travel();
        $bombay_mexico->setCity1($this->getReference('bombay-city'));
        $bombay_mexico->setCity2($this->getReference('mexico-city'));
        $bombay_mexico->setCost(14);
        $manager->persist($bombay_mexico);

        $bta_miami = new Travel();
        $bta_miami->setCity1($this->getReference('bta-city'));
        $bta_miami->setCity2($this->getReference('miami-city'));
        $bta_miami->setCost(4);
        $manager->persist($bta_miami);

        $bta_mexico = new Travel();
        $bta_mexico->setCity1($this->getReference('bta-city'));
        $bta_mexico->setCity2($this->getReference('mexico-city'));
        $bta_mexico->setCost(3);
        $manager->persist($bta_mexico);

        $miami_mexico = new Travel();
        $miami_mexico->setCity1($this->getReference('miami-city'));
        $miami_mexico->setCity2($this->getReference('mexico-city'));
        $miami_mexico->setCost(3);
        $manager->persist($miami_mexico);

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }
}