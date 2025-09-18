<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;

use App\Queries\VaccinatedPatientDataTable;

use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VaccinatedController extends Controller
{
   

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new VaccinatedPatientDataTable())->get())->make(true);
        }

        return view('patient_vaccinated_list.index');
    }

   
}
