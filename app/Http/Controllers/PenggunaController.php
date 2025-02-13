<?php

namespace App\Http\Controllers;

use App\Models\Perusahaans;
use App\Models\Pivotmarketer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class PenggunaController extends Controller
{

    public function index(){
        $data['mitra'] = Perusahaans::all();
        $data['role'] = Role::all();
        return view('pengguna.index', $data);
    }

    public function fetch()
    {
        if(Auth::user()->hasRole('Admin')){
        $user = User::with('mitra')
                            ->get();
        }


        if(Auth::user()->hasRole('Mitra')){
        $user = User::with('mitra')
                            ->where('id',auth()->user()->id)->get();
        }

       
        return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('role', function ($data) {
                    return $data->getRoleNames()->map(function ($role) {
                        return $role;
                    })->implode(' ');
                })
            ->addColumn('action', function ($user) {
                if(Auth::user()->hasRole('Admin')){
                    return '<a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $user->id . '"><i class="ph-pencil-simple"></i></a>
                    <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $user->id . '"><i class="ph-trash"></i></a>';
                }
                 if(Auth::user()->hasRole('Mitra')){
                    return '<a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $user->id . '"><i class="ph-pencil-simple"></i></a>';
                }
                
            })
            ->rawColumns(['action','role'])
            ->make(true);
    }

    public function store(Request $request)
    {
        
        $rule = [
            'nama' => 'required',
            'email' => 'required',
            'hp' => 'required',
            'mitra_id' => 'required',
            'role' => 'required'
        ];

        $message = [
            'nama.required' => 'Tidak Boleh Kosong',
            'email.required' => 'Tidak Boleh Kosong',
            'hp.required' => 'Tidak Boleh Kosong',
            'role.required' => 'Tidak Boleh Kosong',
            'mitra_id.required' => 'Tidak Boleh Kosong'
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {


            $ajax = new User();
            $password = implode('@', explode('@', $request->input('email'), -1));
            $ajax->name = $request->input('nama');
            $ajax->email = $request->input('email');
            $ajax->handphone = $request->input('hp');
            $ajax->mitra_id = $request->input('mitra_id');
            $ajax->password = bcrypt($password);
            $ajax->syncRoles($request->input('role'));
            $ajax->save();
            return response()->json([
                'status' => 200,
                'message' => 'Data tersimpan',
            ]);
        }
    }

    public function edit($id)
    {   
        $user = User::find($id);
        $roles = Role::latest()->get();

         if ($user) {
            return response()->json([
                'status' => 200,
                'users' => $user,
                'role' => $roles
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Users not found',
            ]);
        }
    }

     public function update(Request $request, $id)
    {
        //
         $rule = [
            'edit_nama_pengguna' => 'required',
            'edit_email_pengguna' => 'required',
            'edit_hp_pengguna' => 'required'
        ];

        $message = [
            'edit_nama_pengguna.required' => 'Tidak Boleh Kosong',
            'edit_email_pengguna.required' => 'Tidak Boleh Kosong',
            'edit_hp_pengguna.required' => 'Tidak Boleh Kosong'
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            if ($request->input('edit_password_pengguna') == '') {
                $user = User::find($id);
                $user->name = $request->input('edit_nama_pengguna');
                $user->email = $request->input('edit_email_pengguna');
                $user->handphone = $request->input('edit_hp_pengguna');
                $user->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data updated successfully',
                ]);
            } else {
                $user = User::find($id);
                $user->name = $request->input('edit_nama_pengguna');
                $user->email = $request->input('edit_email_pengguna');
                $user->handphone = $request->input('edit_hp_pengguna');
                $user->password = bcrypt($request->input('edit_password_pengguna'));
                $user->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data updated successfully',
                ]);
            }
        }
    }

    public function destroy(String $id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Berhasil dihapus',
        ]);
    }


}
