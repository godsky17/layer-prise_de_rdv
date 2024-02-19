<?php

namespace App\Http\Controllers;

use App\Http\Requests\RendezvousRequest;
use App\Models\Rendezvous;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RendezvousController extends Controller
{
    //

    public function store(RendezvousRequest $request){
        if($this->checkDiponibility($request)){
            $user = DB::table('users')->insertGetId([
                'last_name' => $request->validated('last_name'),
                'first_name' => $request->validated('first_name'),
                'email' => $request->validated('email'),
                'number' => $request->validated('number'),
                'role_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        
            if ($user) {
                $user = DB::table('rendezvouses')->insert([
                    'date' => $request->validated('day'),
                    'hour' => $request->validated('hour'),
                    'duration' => $request->validated('duration'),
                    'user_id' => $user,
                    'etat_id' => 3,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }else{
                return redirect()->route('getrdv')->with('userNotFound', 'Une erreur sest produite veuiller recommencer en remplissant convenablement le formulaire.');
            }
        }

        return redirect()->route('getrdv')->with('reject', 'Veuillez choisir une autre date.');
    }

    protected function checkDiponibility($request){
        $periodOfRdv = [];
        $rdvOfDate = Rendezvous::where('date', '=', $request->validated('day'))->get();
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
            $beginRdv = new Carbon($information['hour'], +1);
            $endRdv = $beginRdv->add($information['duration'], 'hour');
            array_push($hours, [
                'beginRdv' => $information['hour'],
                'endRdv' => $endRdv->hour.':'.'0'.$endRdv->minute.':'.'0'.$endRdv->second,
            ]);
        }

        return $hours;
    }

    protected function comparHours($hours, $hour, $duration){
        $nowRdvHour = new Carbon($hour, +1);
        $nowRdvEndCarbon = $nowRdvHour->add($duration, 'hour');

        $nowRdvbegin = $hour;
        $nowRdvEnd = $nowRdvEndCarbon->hour.':'.$nowRdvEndCarbon->minute;
        
        
        foreach ($hours as $value) {
            /*===== les conditions ====*/
            $condition1 = ($value['beginRdv'] <= $nowRdvbegin) && ($value['endRdv'] >= $nowRdvEnd);
            $condition2 = ($nowRdvbegin <= $value['beginRdv']) && ($value['endRdv'] >= $nowRdvEnd);
            $condition3 = ($value['beginRdv'] <= $nowRdvbegin) && ($nowRdvEnd >= $value['endRdv']);
            $condition4 = ($nowRdvbegin <= $value['beginRdv']) && ($nowRdvEnd >= $value['endRdv']);

            if ($condition1 || $condition2 || $condition3 || $condition4 ) {
                return false;
            }
        }
        return true;
    }
}
