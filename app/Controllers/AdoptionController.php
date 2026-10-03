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
}