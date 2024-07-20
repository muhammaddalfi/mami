<?php

namespace App\Http\Controllers;

use App\Models\Perusahaans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PerusahaanController extends Controller
{
    public function home()
    {
        return view('perusahaan.index');
    }

    public function store(Request $request)
    {
        $rule = [
            'nama_perusahaan' => 'required'
        ];

        $message = [
            'nama_perusahaan.required' => 'Tidak boleh kosong'
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $ajax = new perusahaans();
            $ajax->nama_perusahaan = $request->input('nama_perusahaan');
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
        $perusahaan = perusahaans::find($id);
        if ($perusahaan) {
            return response()->json([
                'status' => 200,
                'perusahaan' => $perusahaan,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'perusahaan not found',
            ]);
        }
    }
    public function update(Request $request, string $id)
    {
            $perusahaan = perusahaans::find($id);
            $perusahaan->nama_perusahaan = $request->input('edit_nama_perusahaan');

            $perusahaan->update();
            return response()->json([
                'status' => 200,
                'message' => 'Data has been changed!',
            ]);
    }

    public function perusahaan()
    {
        $perusahaan = perusahaans::orderBy('id','ASC')->get();
        
        return DataTables::of($perusahaan)
            ->addIndexColumn()
            
            ->addColumn('action', function ($perusahaan) {
                return '<a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $perusahaan->id . '"><i class="ph-pencil-simple"></i></a>
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $perusahaan->id . '"><i class="ph-trash"></i></a>';
            })
            
            ->rawColumns(['action','images'])
            ->make(true);
    }

    public function destroy($id)
    {
        $perusahaan = perusahaans::find($id);
        $perusahaan->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data has been remove'
        ]);
    }
}
