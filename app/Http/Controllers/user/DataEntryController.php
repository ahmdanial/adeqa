<?php

namespace App\Http\Controllers\user;

use App\Models\EntryResult;
use App\Models\AssignTest;
use App\Models\SubAssignTest;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class DataEntryController extends Controller
{
    public function index()
    {
        $entryResults = EntryResult::all();
        $assignTests = AssignTest::all();
        $assignTestId = $assignTests->first()->id ?? null; // Get the first assignTestId

        return view('user.entry-results', compact('entryResults', 'assignTests', 'assignTestId'));
    }

    public function getAssignTestId(Request $request)
    {
        $labId = $request->lab_id;
        $progId = $request->prog_id;
        $instrumentId = $request->instrument_id;
        $reagentId = $request->reagent_id;

        // Fetch assign_test_id based on the provided parameters
        $assignTestId = AssignTest::where('lab_id', $labId)
            ->where('prog_id', $progId)
            ->where('instrument_id', $instrumentId)
            ->where('reagent_id', $reagentId)
            ->value('id');

        return response()->json(['assignTestId' => $assignTestId]);
    }

    public function showEntryResults($assignTestId)
    {
        // Fetch values of lab_id, prog_id, instrument_id, and reagent_id
        $assignTest = AssignTest::find($assignTestId);

        // Fetch test codes from subassigntest based on assignTestId
        $testCodes = SubAssignTest::where('assign_test_id', $assignTestId)->pluck('testcode');

        // Fetch all assignTests (you might adjust this query based on your actual data structure)
        $assignTests = AssignTest::all();

        // Fetch subAssignTests based on testCodes
        $subAssignTests = SubAssignTest::whereIn('testcode', $testCodes)->get();

        // Pass data to the view
        return view('user.show', [
            'assignTest' => $assignTest,
            'testCodes' => $testCodes,
            'assignTests' => $assignTests,
            'subAssignTests' => $subAssignTests, // Pass the subAssignTests variable
            'lab_id' => $assignTest->lab_id,
            'prog_id' => $assignTest->prog_id,
            'instrument_id' => $assignTest->instrument_id,
            'reagent_id' => $assignTest->reagent_id,
            'assignTestId' => $assignTestId, // Pass the assignTestId variable
        ]);
    }

    public function update(Request $request, $assignTestId)
    {
        $entryResult = EntryResult::findOrFail($assignTestId);

        $entryResult->fill([
            'sampledate' => $request->input('sampledate'),
            'result' => $request->input('result'),
            'entry_id' => $request->input('entry_id'),
            'testcode' => $request->input('testcode'),
            'lab_id' => $request->input('lab_id'),
            'prog_id' => $request->input('prog_id'),
            'instrument_id' => $request->input('instrument_id'),
            'reagent_id' => $request->input('reagent_id'),
            'method_id' => $request->input('method_id'),
            'unit_id' => $request->input('unit_id'),
            'update_by' => auth()->user()->id,
        ]);

        $entryResult->save();

        Session::flash('statuscode', 'info');
        return redirect('/entry-results')->with('status', 'Entry Result Updated Successfully');
    }

    public function delete($id)
    {
        $entryResult = EntryResult::findOrFail($id);
        $entryResult->delete();

        Session::flash('statuscode', 'success');
        return redirect('/entry-results')->with('status', 'Entry Result Deleted Successfully');
    }

    public function viewReceipt(int $id)
    {
        $entryResult = EntryResult::findOrFail($id);

        $path = base_path('public\images\logo2.png');
        $path1 = base_path('public\images\adeqa-black.png');

        $type = pathinfo($path, PATHINFO_EXTENSION);
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);

        $data = file_get_contents($path);
        $data1 = file_get_contents($path1);

        $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $pic1 = 'data:image/' . $type1 . ';base64,' . base64_encode($data1);

        return view('user.receipt.generate-receipt', compact('entryResult', 'pic', 'pic1'));
    }

    public function generateReceipt(int $id)
    {
        $entryResult = EntryResult::findOrFail($id);

        $path = base_path('public\images\logo2.png');
        $path1 = base_path('public\images\adeqa-black.png');

        $type = pathinfo($path, PATHINFO_EXTENSION);
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);

        $data = file_get_contents($path);
        $data1 = file_get_contents($path1);

        $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $pic1 = 'data:image/' . $type1 . ';base64,' . base64_encode($data1);

        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('user.receipt.generate-receipt', ['entryresult' => $entryResult, 'pic' => $pic, 'pic1' => $pic1]);

        // You can customize the filename and headers as needed
        $todayDate = now()->format('Y-m-d');
        return $pdf->download('receipt-'.$entryResult->id.'-'.$todayDate.'.pdf');
    }
}
