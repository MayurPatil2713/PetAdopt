<?php

namespace App\Controllers;

use App\Models\PetModel;

class PetController extends BaseController
{
    protected $petModel;

    public function __construct()
    {
        $this->petModel = new PetModel();
    }

    // Show all pets belonging to logged-in shelter
    public function index()
    {
        $shelterId = session()->get('shelter_id');

        $data['pets'] = $this->petModel
            ->where('shelter_id', $shelterId)
            ->findAll();

        return view('pets/index', $data);
    }

    // Show create form
    public function create()
    {
        return view('pets/create');
    }

    // Save new pet
    public function store()
    {
        $rules = [
            'name' => 'required|max_length[100]',
            'species' => 'required|max_length[50]',
            'breed' => 'required|max_length[100]',
            'age' => 'required|integer',
            'gender' => 'required',
            'vaccination_status' => 'required',
            'description' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $imageName = '';

        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {

            $imageName = $image->getRandomName();

            $image->move(
                FCPATH . 'uploads/pets',
                $imageName
            );
        }

        $this->petModel->insert([
            'shelter_id' => session()->get('shelter_id'),
            'name' => $this->request->getPost('name'),
            'species' => $this->request->getPost('species'),
            'breed' => $this->request->getPost('breed'),
            'age' => $this->request->getPost('age'),
            'gender' => $this->request->getPost('gender'),
            'vaccination_status' => $this->request->getPost('vaccination_status'),
            'description' => $this->request->getPost('description'),
            'image' => $imageName,
            'status' => 'Available'
        ]);

        return redirect()->to('/pets')
            ->with('success', 'Pet added successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $shelterId = session()->get('shelter_id');

        $pet = $this->petModel
            ->where('id', $id)
            ->where('shelter_id', $shelterId)
            ->first();

        if (!$pet) {
            return redirect()->to('/pets')
                ->with('error', 'Pet not found.');
        }

        return view('pets/edit', [
            'pet' => $pet
        ]);
    }

    // Update pet
    public function update($id)
    {
        $shelterId = session()->get('shelter_id');

        $pet = $this->petModel
            ->where('id', $id)
            ->where('shelter_id', $shelterId)
            ->first();

        if (!$pet) {
            return redirect()->to('/pets')
                ->with('error', 'Pet not found.');
        }

        $rules = [
            'name' => 'required|max_length[100]',
            'species' => 'required|max_length[50]',
            'breed' => 'required|max_length[100]',
            'age' => 'required|integer',
            'gender' => 'required',
            'vaccination_status' => 'required',
            'description' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'species' => $this->request->getPost('species'),
            'breed' => $this->request->getPost('breed'),
            'age' => $this->request->getPost('age'),
            'gender' => $this->request->getPost('gender'),
            'vaccination_status' => $this->request->getPost('vaccination_status'),
            'description' => $this->request->getPost('description')
        ];

        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {

            $imageName = $image->getRandomName();

            $image->move(
                FCPATH . 'uploads/pets',
                $imageName
            );

            $data['image'] = $imageName;
        }

        $this->petModel->update($id, $data);

        return redirect()->to('/pets')
            ->with('success', 'Pet updated successfully.');
    }

    // Delete pet
    public function delete($id)
    {
        $shelterId = session()->get('shelter_id');

        $pet = $this->petModel
            ->where('id', $id)
            ->where('shelter_id', $shelterId)
            ->first();

        if (!$pet) {
            return redirect()->to('/pets')
                ->with('error', 'Pet not found.');
        }

        $this->petModel->delete($id);

        return redirect()->to('/pets')
            ->with('success', 'Pet deleted successfully.');
    }

    public function browse()
    {
        $pets = $this->petModel
            ->where('status', 'Available')
            ->findAll();

        return view('pets/browse', [
            'pets' => $pets
        ]);
    }

    public function details($id)
    {
        $pet = $this->petModel
            ->where('id', $id)
            ->where('status', 'Available')
            ->first();

        if (!$pet) {
            return redirect()->to('/pets/browse')
                ->with('error', 'Pet not found or no longer available.');
        }

        return view('pets/details', [
            'pet' => $pet
        ]);
    }
}
