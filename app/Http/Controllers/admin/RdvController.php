<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RendezvousController;
use App\Http\Requests\ReprogammeRequest;
use App\Models\Rendezvous;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\Cast\String_;

class RdvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.rdv',[
            'rdv' => Rendezvous::where('date', '>=', date('Y-m-d'))->where('etat_id', '!=', 5)->orderBy('date', 'asc')->orderBy('hour', 'asc')->get(),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(String $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReprogammeRequest $request, Rendezvous $item)
    {
        //
        

       $valideOrNot = $this->checkDiponibility([
            'date' =>$request->date,
            'hour' =>$request->hour,
        ], $item);

        if ($valideOrNot) {
            $item->etat_id = 2;
            $item->save();
            $item->update([
                'hour' => $request->hour,
                'date' => $request->date,
            ]);
            return redirect()->route('admin.rdv');
        } else {
            return back()->with('notFound', 'Ne marche pas');
        }
        
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function annuler(Rendezvous $item){
        //dd($item);
        $item->etat_id = 5;
        $item->save();
        return redirect()->route('admin.rdv');
    }

    public function reprogrammer(Rendezvous $item){
        return view('admin.reprogrammer', [
            'item' => $item,
        ]);
    }

    protected function checkDiponibility($request, $item){
        $periodOfRdv = [];
        $rdvOfDate = Rendezvous::where('date', '=', $request['date'])->where('etat_id', '!=', 5)->get();
        if ($rdvOfDate) {
            foreach ($rdvOfDate as $value) {
                $array = [
                    'hour' => $value->hour,
                    'duration' => $item->duration,
                ];
                array_push($periodOfRdv, $array);
            }
            return  $this->comparHours($this->getHours($periodOfRdv), $request['hour'], $item->duration);

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
                'endRdv' => $endRdv->hour.':'.$endRdv->minute.':'.$endRdv->second,
            ]);
        }
        return $hours;
    }

    protected function comparHours($hours, $hour, $duration){
       $content = new DateTime($hour);
       $start = new DateTime($hour);
       $end = $content->modify('+'.$duration.' hour')->format('H:i:s');
       $end = new DateTime($end);
       foreach ($hours as $value) {
            $dbBegin = new DateTime($value['beginRdv']);
            $dbEnd = new DateTime($value['endRdv']);

            if (!($end < $dbBegin || $dbEnd < $start)) {
                return false; // Les périodes se chevauchent
            }
       }
       return true;
    }
}
