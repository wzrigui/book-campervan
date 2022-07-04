<?php

namespace App\Controller\Api\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StationRepository;
use App\Repository\RentalOrderRepository;

class StationApiController extends AbstractController
{

    #[Route(path: '/api/v1/stations', name: 'stations', methods: ['GET'])]
    public function getStations(StationRepository $stationRepo): Response
    {
        $stations = $stationRepo->findAll();
        $data = [];
        foreach ($stations as $station) {
            $data[] = [
                'id' => $station->getId(),
                'name' => $station->getName(),
            ];
        }

        return $this->json($data);
    }

    #[Route(path: '/api/v1/station-campervan/{stationId}', name: 'station_campervan', methods: ['GET'])]
    public function getStationCamprevan($stationId, StationRepository $stationRepo): Response
    {
        $station = $stationRepo->findOneById($stationId);
        $data = [];
        foreach ($station->getStationCampers() as $stationCampervan) {
            $data[] = [
                'id' => $stationCampervan->getCampervan()->getId(),
                'name' => $stationCampervan->getCampervan()->getName(),
            ];
        }

        return $this->json($data);
    }

    #[Route(path: '/api/v1/station-equipment/{stationId}', name: 'station_equipment', methods: ['GET'])]
    public function getStationEquipment($stationId, StationRepository $stationRepo): Response
    {
        $station = $stationRepo->findOneById($stationId);
        $data = [];
        foreach ($station->getStationEquipments() as $stationEquipment) {
            $data[] = [
                'id' => $stationEquipment->getEquipment()->getId(),
                'name' => $stationEquipment->getEquipment()->getName(),
                'quantity' => $stationEquipment->getQuantity(),
            ];
        }

        return $this->json($data);
    }

    #[Route(path: '/api/v1/station-booked-equipment/{stationId}', name: 'station_booked_equipment', methods: ['GET'])]
    public function getStationBookedEquipmentByDate($stationId, Request $request, RentalOrderRepository $rentalOrderRepo): Response
    {
        $selectedDate = $request->query->get('selected-date');
        $orders = $rentalOrderRepo->findByStartStation($stationId);
        $data = [];
        foreach ($orders as $order) {
            foreach ($order->getEquipments() as $equipments) {
                if ( $selectedDate >= $order->getStartDate() &&  $selectedDate <= $order->getEndDate())
                $data[] = [
                    'id' => $equipments->getEquipments()->getId(),
                    'name' => $equipments->getEquipments()->getName(),
                    'quantityBooked' => $equipments->getQuantity(),
                ];
            }
        }
        
        return $this->json($data);
    }
} 