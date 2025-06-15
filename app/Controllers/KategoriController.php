<?php

namespace App\Controllers;

use App\Models\CategoryModel;
class KategoriController extends BaseController

{
    protected $category;
    function __construct()
    {
        $this->category = new CategoryModel();
    }

    public function index()
    {
        $category = $this->category->findAll();
        $data['category'] = $category;
        return view('v_kategori', $data);
    }

    public function create()
    {
        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'created_at' => date("Y-m-d H:i:s")
        ];
        $this->category->insert($dataForm);
        return redirect('kategori')->with('success', 'Kategori Berhasil Ditambah');
    }

    public function edit($id)
    {
        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $this->category->update($id, $dataForm);
        return redirect('kategori')->with('success', 'Kategori Berhasil Diubah');
    }

    public function delete($id)
    {
        $this->category->delete($id);
        return redirect('kategori')->with('success', 'Kategori Berhasil Dihapus');
    }
  
}
