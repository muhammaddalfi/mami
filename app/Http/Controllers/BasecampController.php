<?php

namespace App\Http\Controllers;

use App\Models\Basecamps;
use App\Models\Perusahaans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class BasecampController extends Controller
{
    public function home()
    {
        $data['mitra'] = Perusahaans::all();
        return view('basecamp.index',$data);
    }

    public function store(Request $request)
    {
        $rule = [
            'nama_basecamp' => 'required',
            'mitra_id' => 'required'
        ];

        $message = [
            'nama_basecamp.required' => 'Tidak boleh kosong',
            'mitra_id.required' => 'Tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $ajax = new Basecamps();
            $ajax->nama_basecamp = $request->input('nama_basecamp');
            $ajax->mitra_id = $request->input('mitra_id');
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
        $basecamp = Basecamps::find($id);
        if ($basecamp) {
            return response()->json([
                'status' => 200,
                'basecamp' => $basecamp,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'basecamp not found',
            ]);
        }
    }
    public function update(Request $request, string $id)
    {
            $basecamp = Basecamps::find($id);
            $basecamp->nama_basecamp = $request->input('edit_nama_basecamp');
            $basecamp->mitra_id = $request->input('edit_mitra_id');

            $basecamp->update();
            return response()->json([
                'status' => 200,
                'message' => 'Data has been changed!',
            ]);
    }

    public function basecamp()
    {
        $basecamp = Basecamps::with('perusahaan')->get();
        
        return DataTables::of($basecamp)
            ->addIndexColumn()
            
            ->addColumn('action', function ($basecamp) {
                return '<a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $basecamp->id . '"><i class="ph-pencil-simple"></i></a>
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $basecamp->id . '"><i class="ph-trash"></i></a>';
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }

    public function destroy($id)
    {
        $basecamp = Basecamps::find($id);
        $basecamp->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data has been remove'
        ]);
    }
}
