<?php

namespace App\Http\Controllers;

use App\Exports\BaddebExport;
use App\Models\Incidents;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class LaporanIncident extends Controller
{
    //
    public function index(){
        return view('laporan.index');
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {        
                if($request->filled('from_date') && $request->filled('end_date'))
                {
                     if(Auth::user()->hasRole('Admin')){
                             $data_ ="SELECT 
                                    i.id, i.no_incident, i.nama_incident, i.tgl_incident,
                                    m.jenis_material,
                                    b.nama_basecamp,
                                    u.name
                                FROM incidents i
                                LEFT JOIN materials m ON m.id = i.material_id
                                LEFT JOIN basecamps b ON b.id = i.basecamp_id
                                LEFT JOIN users u ON u.id = i.user_id
                                WHERE tgl_incident BETWEEN ? AND ?
                                ORDER BY i.id DESC";
                     }

                     if(Auth::user()->hasRole('Mitra')){
                             $data_ ="SELECT 
                                    i.id, i.no_incident, i.nama_incident, i.tgl_incident,
                                    m.jenis_material,
                                    b.nama_basecamp,
                                    u.name
                                FROM incidents i
                                LEFT JOIN materials m ON m.id = i.material_id
                                LEFT JOIN basecamps b ON b.id = i.basecamp_id
                                LEFT JOIN users u ON u.id = i.user_id
                                WHERE tgl_incident BETWEEN ? AND ?
                                AND i.user_id = '".Auth()->user()->id."'
                                ORDER BY i.id DESC";
                     }
                    
                        $data = DB::select($data_,[$request->from_date,$request->end_date]);
                }

                
                
            return DataTables::of($data)
                ->addIndexColumn()
                 ->addColumn('tgl_incident', function ($data) {
                $formatDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->tgl_incident)->format('d-m-Y');
                return $formatDate;
                })
                ->addColumn('action', function ($data) {
                    return '<a href="javascript:void(0)" class="btn btn-outline-success btn-icon ml-2 view" data-id="' . $data->id . '"><i class="ph-eye"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
                
        }
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

    public function export()
    {
        return Excel::download(new BaddebExport, 'laporan.xlsx');
    }

}
