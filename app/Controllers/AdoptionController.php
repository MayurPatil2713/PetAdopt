<?php

namespace App\Controllers;

use App\Models\PetModel;
use App\Models\AdoptionRequestModel;

class AdoptionController extends BaseController
{
    protected $petModel;
    protected $requestModel;

    public function __construct()
    {
        $this->petModel = new PetModel();
        $this->requestModel = new AdoptionRequestModel();
    }

    // Show adoption form for a pet
    public function create($petId)
    {
        $pet = $this->petModel
            ->where('id', $petId)
            ->where('status', 'Available')
            ->first();

        if (!$pet) {
            return redirect()->to('/pets')
                ->with('error', 'Pet is not available for adoption.');
        }

        return view('adoption/create', [
            'pet' => $pet
        ]);
    }

    // Save adoption request
    public function store($petId)
    {
        $pet = $this->petModel
            ->where('id', $petId)
            ->where('status', 'Available')
            ->first();

        if (!$pet) {
            return redirect()->to('/pets')
                ->with('error', 'Pet is not available for adoption.');
        }

        $rules = [
            'adopter_name' => 'required|min_length[2]|max_length[100]',
            'adopter_email' => 'required|valid_email|max_length[150]',
            'phone' => 'required|max_length[20]',
            'address' => 'required',
            'occupation' => 'permit_empty|max_length[100]',
            'reason' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->requestModel->insert([
            'pet_id' => $petId,
            'adopter_name' => $this->request->getPost('adopter_name'),
            'adopter_email' => $this->request->getPost('adopter_email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'occupation' => $this->request->getPost('occupation'),
            'reason' => $this->request->getPost('reason'),
            'status' => 'Pending'
        ]);

        return redirect()->to('/pets')
            ->with('success', 'Adoption request submitted successfully.');
    }

    public function index()
    {
        $shelterId = session()->get('shelter_id');

        $requests = $this->requestModel
            ->select('adoption_requests.*, pets.name AS pet_name')
            ->join('pets', 'pets.id = adoption_requests.pet_id')
            ->where('pets.shelter_id', $shelterId)
            ->orderBy('adoption_requests.created_at', 'DESC')
            ->findAll();

        return view('adoption/index', [
            'requests' => $requests
        ]);
    }

    public function approve($requestId)
    {
        $shelterId = session()->get('shelter_id');

        $request = $this->requestModel
            ->select('adoption_requests.*, pets.shelter_id, pets.status AS pet_status')
            ->join('pets', 'pets.id = adoption_requests.pet_id')
            ->where('adoption_requests.id', $requestId)
            ->where('pets.shelter_id', $shelterId)
            ->first();

        if (!$request) {
            return redirect()->to('/adoption/requests')
                ->with('error', 'Adoption request not found.');
        }

        if ($request['status'] !== 'Pending') {
            return redirect()->to('/adoption/requests')
                ->with('error', 'This request has already been processed.');
        }

        if ($request['pet_status'] !== 'Available') {
            return redirect()->to('/adoption/requests')
                ->with('error', 'This pet is no longer available.');
        }

        // Approve request
        $this->requestModel->update($requestId, [
            'status' => 'Approved'
        ]);

        // Change pet status
        $this->petModel->update($request['pet_id'], [
            'status' => 'Adopted'
        ]);

        // Reject other pending requests for the same pet
        $this->requestModel
            ->where('pet_id', $request['pet_id'])
            ->where('status', 'Pending')
            ->where('id !=', $requestId)
            ->set(['status' => 'Rejected'])
            ->update();

        return redirect()->to('/adoption/requests')
            ->with('success', 'Adoption request approved successfully.');
    }

    public function reject($requestId)
    {
        $shelterId = session()->get('shelter_id');

        $request = $this->requestModel
            ->select('adoption_requests.*, pets.shelter_id')
            ->join('pets', 'pets.id = adoption_requests.pet_id')
            ->where('adoption_requests.id', $requestId)
            ->where('pets.shelter_id', $shelterId)
            ->first();

        if (!$request) {
            return redirect()->to('/adoption/requests')
                ->with('error', 'Adoption request not found.');
        }

        if ($request['status'] !== 'Pending') {
            return redirect()->to('/adoption/requests')
                ->with('error', 'This request has already been processed.');
        }

        $this->requestModel->update($requestId, [
            'status' => 'Rejected'
        ]);

        return redirect()->to('/adoption/requests')
            ->with('success', 'Adoption request rejected.');
    }
    }