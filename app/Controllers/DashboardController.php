<?php

namespace App\Controllers;

use App\Models\PetModel;
use App\Models\AdoptionRequestModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $shelterId = session()->get('shelter_id');

        $petModel = new PetModel();
        $requestModel = new AdoptionRequestModel();

        $data['totalPets'] = $petModel
            ->where('shelter_id', $shelterId)
            ->countAllResults();

        $data['availablePets'] = $petModel
            ->where('shelter_id', $shelterId)
            ->where('status', 'Available')
            ->countAllResults();

        $data['adoptedPets'] = $petModel
            ->where('shelter_id', $shelterId)
            ->where('status', 'Adopted')
            ->countAllResults();

        $data['pendingRequests'] = $requestModel
            ->join('pets', 'pets.id = adoption_requests.pet_id')
            ->where('pets.shelter_id', $shelterId)
            ->where('adoption_requests.status', 'Pending')
            ->countAllResults();

        return view('dashboard', $data);
    }
}