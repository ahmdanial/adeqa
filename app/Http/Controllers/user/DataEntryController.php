<?php

namespace App\Http\Controllers\user;

use App\Models\EntryResult;
use App\Models\Program;
use App\Models\Lab;
use App\Models\Instrument;
use App\Models\Reagent;
use App\Models\Method;
use App\Models\Unit;
use App\Models\Test;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class DataEntryController extends Controller
{
    public function index()
    {
        $entryresults = EntryResult::all();
        $programs = Program::all();
        $labs = Lab::all();
        $instruments = Instrument::all();
        $reagents = Reagent::all();
        $methods = Method::all();
        $units = Unit::all();
        $tests = Test::all();

        return view('user.entry-results', compact('entryresults', 'programs', 'labs', 'instruments', 'reagents', 'methods', 'units', 'tests'));
    }

    public function store(Request $request)
    {
        $entryresult = new EntryResult;

        $entryresult->sampledate = $request->input('sampledate');
        $entryresult->lab_id = $request->input('lab_id');
        $entryresult->prog_id = $request->input('prog_id');
        $entryresult->instrument_id = $request->input('instrument_id');
        $entryresult->reagent_id = $request->input('reagent_id');
        $entryresult->testcode = $request->input('testcode');
        $entryresult->method_id = $request->input('method_id');
        $entryresult->unit_id = $request->input('unit_id');
        $entryresult->result = $request->input('result');
        $entryresult->added_by = auth()->user()->id;
        $entryresult->update_by = auth()->user()->id;

        $entryresult->save();

        Session::flash('statuscode', 'success');
        return redirect('/entry-results')->with('status', 'Test Assigned Successfully');
    }

    public function edit($id)
    {
        $entryresult = EntryResult::findOrFail($id);
        $programs = Program::all();
        $labs = Lab::all();
        $instruments = Instrument::all();
        $reagents = Reagent::all();
        $methods = Method::all();
        $units = Unit::all();
        $tests = Test::all();

        return view('user.assign.edit-result', compact('entryresult', 'programs', 'labs', 'instruments', 'reagents', 'methods', 'units', 'tests'));
    }

    public function update(Request $request, $id)
    {
        $entryresult = EntryResult::findOrFail($id);

        $entryresult->sampledate = $request->input('sampledate');
        $entryresult->lab_id = $request->input('lab_id');
        $entryresult->prog_id = $request->input('prog_id');
        $entryresult->instrument_id = $request->input('instrument_id');
        $entryresult->reagent_id = $request->input('reagent_id');
        $entryresult->testcode = $request->input('testcode');
        $entryresult->method_id = $request->input('method_id');
        $entryresult->unit_id = $request->input('unit_id');
        $entryresult->result = $request->input('result');
        $entryresult->update_by = auth()->user()->id;

        $entryresult->update();

        Session::flash('statuscode', 'info');
        return redirect('/entry-results')->with('status', 'Assigned Test Updated Successfully');
    }

    public function delete($id)
    {
        $entryresult = EntryResult::findOrFail($id);
        $entryresult->delete();

        Session::flash('statuscode', 'success');
        return redirect('/entry-results')->with('status', 'Assigned Test Deleted Successfully');
    }

    public function viewReceipt(int $id)
    {
        $path = base_path('public\images\logo2.png');
        $path1 = base_path('public\images\adeqa-black.png');

        $type = pathinfo($path, PATHINFO_EXTENSION);
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);

        $data = file_get_contents($path);
        $data1 = file_get_contents($path1);

        $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $pic1 = 'data:image/' . $type1 . ';base64,' . base64_encode($data1);

        $entryresult = EntryResult::findOrFail($id);
        return view('user.receipt.generate-receipt', compact('entryresult', 'pic', 'pic1'));
    }

    public function generateReceipt(int $id)
    {
        $path = base_path('public\images\logo2.png');
        $path1 = base_path('public\images\adeqa-black.png');

        $type = pathinfo($path, PATHINFO_EXTENSION);
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);

        $data = file_get_contents($path);
        $data1 = file_get_contents($path1);

        $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $pic1 = 'data:image/' . $type1 . ';base64,' . base64_encode($data1);

        $entryresult = EntryResult::findOrFail($id);

        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('user.receipt.generate-receipt', ['entryresult' => $entryresult, 'pic' => $pic, 'pic1' => $pic1]);

        // You can customize the filename and headers as needed
        $todayDate = now()->format('Y-m-d');
        return $pdf->download('receipt-'.$entryresult->id.'-'.$todayDate.'.pdf');
    }

}
