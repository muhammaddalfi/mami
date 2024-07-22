<?php

namespace App\Http\Controllers;

use App\Models\Materials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class MaterialController extends Controller
{
    //

    public function home()
    {
        return view('material.index');
    }

    public function store(Request $request)
    {
        $rule = [
            'jenis_material' => 'required',
            'harga_material' => 'required'
        ];

        $message = [
            'jenis_material.required' => 'Tidak boleh kosong',
            'harga_material.required' => 'Tidak boleh kosong'
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $ajax = new Materials();
            $ajax->jenis_material = $request->input('jenis_material');
            $ajax->harga_material = $request->input('harga_material');
            $ajax->save();
            return response()->json([
                'status' => 200,
                'message' => 'Data saved successfully',
            ]);
        }
    }

     public function edit($id)
    {
        //
        $material = Materials::find($id);
        if ($material) {
            return response()->json([
                'status' => 200,
                'material' => $material,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'material not found',
            ]);
        }
    }
    public function update(Request $request, string $id)
    {
            $material = Materials::find($id);
            $material->jenis_material = $request->input('edit_jenis_material');
            $material->harga_material = $request->input('edit_harga_material');

            $material->update();
            return response()->json([
                'status' => 200,
                'message' => 'Data has been changed!',
            ]);
    }

    public function material()
    {
        $material = Materials::orderBy('id','ASC')->get();
        
        return DataTables::of($material)
            ->addIndexColumn()
            ->addColumn('action', function ($material) {
                return '<a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $material->id . '"><i class="ph-pencil-simple"></i></a>
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $material->id . '"><i class="ph-trash"></i></a>';
            })
            
            ->rawColumns(['action','images'])
            ->make(true);
    }

    public function destroy($id)
    {
        $material = Materials::find($id);
        $material->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data has been remove'
        ]);
    }
}
