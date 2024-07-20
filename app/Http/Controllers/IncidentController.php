<?php

namespace App\Http\Controllers;

use App\Models\Basecamps;
use App\Models\Incidents;
use App\Models\Materials;
use App\Models\Perusahaans;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class IncidentController extends Controller
{
    //
    public function home()
    {
        $data['basecamp'] = Basecamps::with('perusahaan')
                            ->where('mitra_id',auth()->user()->mitra_id)->get();
        $data['material'] = Materials::all();
        return view('incident.index', $data);
    }

    public function store(Request $request)
    {
        $rule = [
            'no_incident' => 'required',
            'nama_incident' => 'required',
            'tgl_incident' => 'required',
            'lokasi' => 'required',
            'lat' => 'required',
            'lon' => 'required',
            'basecamp_serpo' => 'required',
            'jenis_material' => 'required',
            'image_compressed' => 'required|image|mimes:jpeg,png,jpg|max:5048',
        ];

        $message = [
            'no_incident.required' => 'This field is required',
            'nama_incident.required' => 'This field is required',
            'tgl_incident.required' => 'This field is required',
            'lokasi.required' => 'This field is required',
            'lat.required' => 'This field is required',
            'lon.required' => 'This field is required',
            'basecamp_serpo.required' => 'This field is required',
            'jenis_material.required' => 'This field is required',
            'jumlah_material.required' => 'This field is required',
            'image_compressed.required' => 'This field is required',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $path = 'files/';
            $gambar = $request->file('image_compressed');
            $format_name_images = time() . '.' . $gambar->extension();
            $gambar->storeAs($path, $format_name_images, 'public');


            $ajax = new Incidents();
            $ajax->user_id = auth()->user()->id;
            $ajax->no_incident = $request->input('no_incident');
            $ajax->nama_incident = $request->input('nama_incident');
            $ajax->tgl_incident = Carbon::parse($request->input('tgl_incident'));
            $ajax->lokasi = $request->input('lokasi');
            $ajax->lat = $request->input('lat');
            $ajax->lng = $request->input('lon');
            $ajax->basecamp_id = $request->input('basecamp_serpo');
            $ajax->material_id = $request->input('jenis_material');
            $ajax->jumlah_material = $request->input('jumlah_material');
            $ajax->gambar = $format_name_images;
            $ajax->save();
            return response()->json([
                'status' => 200,
                'message' => 'Data saved successfully',
            ]);
        }
    }

    public function fetch()
    {
     
        if(Auth::user()->hasRole('Admin')){
            $incident = Incidents::with(['user', 'basecamp','material'])->get();
        }

        if(Auth::user()->hasRole('Mitra')){
            $incident = Incidents::with(['user', 'basecamp','material'])
                        ->where('user_id',Auth()->user()->id)->get();
        }

        return DataTables::of($incident)
            ->addIndexColumn()
            ->addColumn('tgl_incident', function ($incident) {
                $formatDate = Carbon::createFromFormat('Y-m-d H:i:s', $incident->tgl_incident)->format('d-m-Y');
                return $formatDate;
            })
            ->addColumn('action', function ($incident) {
                return '<a href="javascript:void(0)" class="btn btn-outline-success btn-icon ml-2 view" data-id="' . $incident->id . '"><i class="ph-eye"></i></a>
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $incident->id . '"><i class="ph-trash"></i></a>';
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show($id)
    {
        $incident = Incidents::with(['user','basecamp','material'])->find($id);
        if ($incident) {
            return response()->json([
                'status' => 200,
                'incident' => $incident
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Daily not found',
            ]);
        }
    }

    public function edit($id)
    {
        //
        $incident = Incidents::with(['user', 'basecamp', 'mitra', 'material'])->find($id);
        if ($incident) {
            return response()->json([
                'status' => 200,
                'incident' => $incident,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'incidents not found',
            ]);
        }
    }

    public function destroy($id)
    {
        $incident = Incidents::find($id);
        $deletedFile  = File::delete("storage/files/" . $incident->gambar);
        if (File::exists($deletedFile)) {
            File::delete($deletedFile);
        }
        $incident->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data has been remove'
        ]);
    }
}
