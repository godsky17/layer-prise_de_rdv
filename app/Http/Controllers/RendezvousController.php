<?php

namespace App\Http\Controllers;

use App\Http\Requests\RendezvousRequest;
use App\Models\Rendezvous;
use Carbon\Carbon;
use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class RendezvousController extends Controller
{
    //

    public function store(RendezvousRequest $request){
        $is_valid = $this->checkDiponibility($request);
        if($is_valid)
        {
            $user = DB::table('users')->insertGetId([
                'last_name' => $request->validated('last_name'),
                'first_name' => $request->validated('first_name'),
                'email' => $request->validated('email'),
                'number' => $request->validated('number'),
                'role_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        
            if ($user) 
            {
                $user = DB::table('rendezvouses')->insert([
                    'date' => $request->validated('day'),
                    'hour' => $request->validated('hour'),
                    'duration' => $request->validated('duration'),
                    'user_id' => $user,
                    'etat_id' => 3,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                return redirect()->route('index');
            }else
            {
                return redirect()->route('getrdv')->with('userNotFound', 'Une erreur sest produite veuiller recommencer en remplissant convenablement le formulaire.');
            }
        }

        return redirect()->route('getrdv')->with('reject', 'Veuillez choisir une autre date.');
    }

    protected function checkDiponibility($request){
        $periodOfRdv = [];
        $rdvOfDate = Rendezvous::where('date', '=', $request->validated('day'))->where('etat_id', '!=', 5)->get();
        
        if ($rdvOfDate) {
            foreach ($rdvOfDate as $value) {
                $array = [
                    'hour' => $value->hour,
                    'duration' => $value->duration,
                ];
                array_push($periodOfRdv, $array);
            }

            return  $this->comparHours($this->getHours($periodOfRdv), $request->validated('hour'), $request->validated('duration'));

        }
        
        return true;
    }

    protected function getHours($informations){

        $hours = [];

        foreach ($informations as $information) {
            $beginRdv = new DateTime($information['hour']);
            $endRdv = $beginRdv->modify('+'.$information['duration'].'hour')->format('H:i:s');
            array_push($hours, [
                'beginRdv' => $information['hour'],
                'endRdv' => $endRdv
            ]);
        }
        return $hours;
    }

    protected function comparHours($pastHours, $newHours,  $duration){
        $startInt = new DateTime($newHours);
        
        $start = new DateTime($newHours);
        $end = $startInt->modify('+'.$duration.' hour')->format('H:i:s');
        $end = new DateTime($end);

        $count = 0;

        foreach ($pastHours as $value) {
            $dbBegin = new DateTime($value['beginRdv']);
            $dbEnd = new DateTime($value['endRdv']);

            if (!($end < $dbBegin || $dbEnd < $start)) {
                return false; // Les périodes se chevauchent
            }
        }

        return true;

    }   
}
