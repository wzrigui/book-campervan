<?php

namespace App\Controller\Api\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StationRepository;
use App\Repository\RentalOrderRepository;

class OrderApiController extends AbstractController
{

    #[Route(path: '/api/v1/order', name: 'new_order', methods: ['POST'])]
    public function createOrder(Request $request, RentalOrderRepository $orderRepo): Response
    {
        $data = [];
        $startStationId = $request->query->get('start-station-id');
        $endStationId = $request->query->get('end-station-id');
        $startDate = $request->query->get('start-station-id');
        $endDate = $request->query->get('end-station-id');
        $campervanId = $request->query->get('campervan-id');
        $equipments = $request->query->get('equipment-ids');
        /**
         * didnt developed much here as spent most of time working on the station side
         * 
         */

        return $this->json($data,status = 201);
    }
} 