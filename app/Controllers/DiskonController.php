<?php

namespace App\Controllers;

use App\Models\DiscountModel;

class DiskonController extends BaseController

{
    protected $discount;
    function __construct()
    {
        $this->discount = new DiscountModel();
    }

    public function index()
    {
        $discount = $this->discount->findAll();
        $data['discount'] = $discount;
        return view('v_diskon', $data);
    }

    public function create()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'tanggal' => [
                'label' => 'Tanggal',
                'rules' => 'required|is_unique[discounts.tanggal]',
                'errors' => [
                    'required' => 'Tanggal harus diisi.',
                    'is_unique' => 'Tanggal sudah ada, tidak boleh duplikat.'
                ]
            ],
            'nominal' => [
                'label' => 'Nominal',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Nominal harus diisi.',
                    'numeric' => 'Nominal harus berupa angka.'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('failed', $validation->getErrors());
        }
        $dataForm = [
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal'),
            'created_at' => date("Y-m-d H:i:s")
        ];
        $this->discount->insert($dataForm);
        return redirect('diskon')->with('success', 'Diskon Berhasil Ditambah');
    }

    public function edit($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'tanggal' => [
                'label' => 'Tanggal',
                'rules' => 'required|is_unique[discounts.tanggal,id,{id}]',
                'errors' => [
                    'required' => 'Tanggal harus diisi.',
                    'is_unique' => 'Tanggal sudah ada, tidak boleh duplikat.'
                ]
            ],
            'nominal' => [
                'label' => 'Nominal',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Nominal harus diisi.',
                    'numeric' => 'Nominal harus berupa angka.'
                ]
            ]
        ]);

        $rules = $validation->getRules();
        $rules['tanggal']['rules'] = str_replace('{id}', $id, $rules['tanggal']['rules']);
        $validation->setRules($rules);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('failed', $validation->getErrors());
        }

        $dataForm = [
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal'),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $this->discount->update($id, $dataForm);
        return redirect('diskon')->with('success', 'Diskon Berhasil Diubah');
    }

    public function delete($id)
    {
        $this->discount->delete($id);
        return redirect('diskon')->with('success', 'Diskon Berhasil Dihapus');
    }
}
