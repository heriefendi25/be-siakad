<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = DB::table('users')->when($request->input('name'), function ($query, $name) {
                            return $query->where('name','like', '%' . $name . '%');
                            })
                    ->select('id','name','email','phone','address', DB::raw('DATE_FORMAT(created_at, "%d/%m/%Y") as created_at'))
                    ->paginate(20);
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = new User;
        return view('user.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request = $request->all();

        $act = false;
        try {
            \DB::beginTransaction();

            $user = new User;
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password = Hash::make($request['password']);
            $user->roles = $request['roles'];
            $user->phone = $request['phone'];
            $user->address = $request['address'];
            $user->save();
            
            \DB::commit();
            $act = true;
        } catch (\Exception $e) {
            \DB::rollBack();
            // dd($e->getMessage());
        }

        if ($act) {
            return redirect(route('users.index'))->with('success', 'User baru berhasil ditambahkan');
        } else {
            return redirect(route('users.index'))->with('error', 'Gagal menambahkan user');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = User::find($id);
        return view('user.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);
        $request = $request->all();

        // dd($request);
        $act = false;
        try {
            \DB::beginTransaction();
            
            $data->name = $request['name'];
            $data->email = $request['email'];
            $data->roles = $request['roles'];
            $data->phone = $request['phone'];
            $data->address = $request['address'];

            $data->save();
            
            \DB::commit();
            $act = true;
        } catch (\Exception $e) {
            \DB::rollBack();
            // dd($e->getMessage());
        }

        if ($act) {
            return redirect(route('users.index'))->with('success', 'Data pengguna berhasil diperbarui');
        } else {
            return redirect(route('users.index'))->with('error', 'Gagal memperbarui data pengguna');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::find($id);
        if(empty($data)) abort(404);

        $act = $data->delete();
        
        if ($act) {
            return redirect(route('users.index'))->with('success', 'Data pengguna berhasil dihapus');
        } else {
            return redirect(route('users.index'))->with('error', 'Gagal memperbarui data pengguna');
        }
    }
}
