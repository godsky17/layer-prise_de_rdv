<?php

namespace App\Http\Controllers;

use App\Http\Requests\RendezvousRequest;
use App\Models\Rendezvous;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RendezvousController extends Controller
{
    //

    public function store(RendezvousRequest $request){

        $verification = $this->checkDiponibility($request);
        dd($verification);

        $user = DB::table('users')->insertGetId([
        'last_name' => $request->validated('last_name'),
        'first_name' => $request->validated('first_name'),
        'email' => $request->validated('email'),
        'number' => $request->validated('number'),
        'role_id' => 3,
        'created_at' => date('Y-m-d H:i:s'),
        'update_at' => date('Y-m-d H:i:s'),
        ]);

        if ($user) {
            $user = DB::table('rendezvouses')->insert([
                'date' => $request->validated('day'),
                'hour' => $request->validated('hour'),
                'duration' => $request->validated('duration'),
                'user_id' => $user,
                'etat_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'update_at' => date('Y-m-d H:i:s'),
            ]);
            echo 'enregistrer';
        }
    }

    protected function checkDiponibility($request){
        $periodOfRdv = [];
        $rdvOfDate = Rendezvous::where('date', '=', $request->validated('day'))->get();
        foreach ($rdvOfDate as $value) {
            $array = [
                'hour' => $value->hour,
                'duration' => $value->duration,
            ];
            array_push($periodOfRdv, $array);
        }

        return $periodOfRdv;
    }
}
