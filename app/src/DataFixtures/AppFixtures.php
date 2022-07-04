<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Station;
use App\Entity\Equipment;
use App\Entity\Campervan;
use App\Entity\StationCamper;
use App\Entity\StationEquipment;
use App\Entity\RentalOrder;
use App\Entity\RentalOrderEquipment;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 6; ++$i) {
            $stations = new Station();
            $stations->setName('Station' . $i); 
            $manager->persist($stations);
            for ($j = 1; $j < 6; ++$j) {
                $campervans = new Campervan();
                $campervans->setName('Campervan' . $i . $j);
                $equipments = new Equipment();
                $equipments->setName('equipment' . $i . $j);
                $equipments->setOrderQuantityLimit($j);
                $stationCamper = new StationCamper();
                $stationCamper->setStation($stations); 
                $stationCamper->setCampervan($campervans); 
                $stationEquipment = new StationEquipment();
                $stationEquipment->setStation($stations); 
                $stationEquipment->setEquipment($equipments); 
                $stationEquipment->setQuantity($j); 
                $manager->persist($campervans);
                $manager->persist($equipments);
                $manager->persist($stationCamper);
                $manager->persist($stationEquipment);
            }
            $rentalOrder = new RentalOrder();
            $rentalOrder->setStartStation($stations);
            $rentalOrder->setEndStation($stations);
            $rentalOrder->setStartDate((new \DateTime())->sub(new \DateInterval('P' . $i . 'D')));
            $rentalOrder->setEndDate((new \DateTime())->add(new \DateInterval('P' . $i . 'D')));
            $rentalOrderEquipment = new RentalOrderEquipment();
            $rentalOrderEquipment->setEquipments($equipments);
            $rentalOrderEquipment->setRentalOrders($rentalOrder);
            $rentalOrderEquipment->setQuantity(1);
            $rentalOrder->addEquipment($rentalOrderEquipment);
            $rentalOrder->setCampervan($campervans);
            $manager->persist($rentalOrderEquipment);
            $manager->persist($rentalOrder);
        }

        $manager->flush();
    }
}
