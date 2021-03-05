<?php

namespace App\Http\Controllers;

use App\Models\Persons;
use Illuminate\Http\Request;
use App\Models\Profiles;

use DB;

class PersonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('persons')
        ->join('profiles', 'persons.id', '=', 'profiles.persons_id')
        ->where('persons.deleted_at', null)
        ->select('persons.*', 'profiles.ima_profile')
        ->get();
        return response()->json($users);

      //  return response()->json(Profiles::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'description' => 'required',
            'ima_profile' => 'required'
        ]);

        $user =  Persons::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'description' => $data['description']
        ]);

       // echo($user);

        $profile = Profiles::create([
            'persons_id' => $user->id,
            'ima_profile' => $data['ima_profile']
        ]);

       // echo($profile);
        return response($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persons  $persons
     * @return \Illuminate\Http\Response
     */
    public function show(Persons $persons, $id)
    {
        $users = DB::table('persons')
                      ->join('profiles', 'persons.id', '=', 'profiles.persons_id')
                      ->where('persons.id', $id)
                      ->select('persons.*', 'profiles.ima_profile')
                      ->get();
        return response()->json($users);
    }

    public function jtime ($inicio, $final)
    {
        $users = DB::table('persons')
                    ->join('profiles', 'persons.id', '=', 'profiles.persons_id' )
                    /*->where(function($query){
                        $query->whereDate('users.created_at', '>=', $inicio)
                        ->whereDate('users.created_at', '<=', $final);
                    })*/
                    ->whereBetween('persons.created_at', [$inicio, $final])
                    ->get();
                    return response()->json($users);
    }

    public function search ($name, $name2){
        if($name2=='null'){
            $user = DB::table('persons')
                    ->join('profiles', 'persons.id', '=', 'profiles.persons_id' )
                    ->where('first_name', 'like', $name."%")
                    ->get();
                    return response()->json($user);
        }else {
            $user = DB::table('persons')
            ->join('profiles', 'persons.id', '=', 'profiles.persons_id' )
            //->where('first_name', 'like', $name."%")
            ->where([
                ['first_name', 'like', $name."%"],
                ['last_name', 'like', $name2."%"],
            ])
            ->get();
            return response()->json($user);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persons  $persons
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persons $persons, $id)
    {
        $user = Persons::find($id);
        if(is_null($user)){
            return response()->json(['message' => 'USer Not Found'], 404);
        }
        $user->update($request->all());
            return response($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persons  $persons
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persons $persons, $id)
    {
        $profile = Profiles::where('persons_id', $id)->first();
        $profile->delete();
        $user = Persons::find($id);
        if(is_null($user)) {
            return response()->json(['message' => 'User Not Found'], 404);
        }
        $user->delete();
        return response()->json(null, 200);
    }

    public function deleteSoft(){

        $user = Persons::onlyTrashed()->get();

        return response()->json($user, 200);


    }

}
