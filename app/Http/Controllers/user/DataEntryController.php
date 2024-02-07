<?php

namespace App\Http\Controllers\user;

use App\Models\EntryResult;
use App\Models\AssignTest;
use App\Models\SubAssignTest;
use App\Models\Method;
use App\Models\Reagent;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataEntryController extends Controller
{

    public function index()
    {
        // Fetch all AssignTests (you might adjust this query based on your actual data structure)
        $assignTests = AssignTest::all();

        // Fetch the methodDetails for the first AssignTest (you might adjust this query based on your actual data structure)
        $assignTestId = $assignTests->id ?? null;

        // Fetch other data based on the obtained $assignTestId
        $entryResults = EntryResult::all();
        $methodDetails = Method::find($assignTestId);
        $reagents = Reagent::all();

        return view('user.entry-results', compact('entryResults', 'assignTests', 'assignTestId', 'methodDetails', 'reagents'));
    }

    public function getAssignTestId(Request $request)
    {
        $labId = $request->input('lab_id');
        $progId = $request->input('prog_id');
        $instrumentId = $request->input('instrument_id');
        $reagentId = $request->input('reagent_id');

        // Now, filter the Subassigntest based on lab_id, prog_id, instrument_id, and reagent_id
        $subAssignTest = SubAssignTest::whereHas('assignTest', function ($query) use ($labId, $progId, $instrumentId, $reagentId) {
            $query->where([
                'lab_id' => $labId,
                'prog_id' => $progId,
                'instrument_id' => $instrumentId,
                'reagent_id' => $reagentId,
            ]);
        })->first();

        if ($subAssignTest) {
            $assignTestId = $subAssignTest->assign_test_id;

            // Redirect to the page showing the listing of testcodes
            return redirect()->route('entry-results.showEntryResults', ['assignTestId' => $assignTestId, 'reagentId' => $reagentId]);
        } else {
            // Handle error, maybe redirect back with an error message
            return redirect()->back()->with('error', 'AssignTestId not found for the given parameters.');
        }
    }

    public function showEntryResults($assignTestId)
    {
        $subAssignTests = SubAssignTest::where('assign_test_id', $assignTestId)->get();

        // Fetch values of lab_id, prog_id, instrument_id, and reagent_id
        $assignTest = AssignTest::with('subAssignTests')
            ->find($assignTestId);

        // Fetch test codes from subassigntest based on assignTest relationship
        $testCodes = $assignTest->subAssignTests->pluck('testcode');

        // Fetch method details based on the test codes
        $methodDetails = Method::whereIn('testcode', $testCodes)
            ->pluck('methodname', 'testcode')
            ->toArray();

        // Fetch reagent details using the query
        $reagentDetails = DB::table('methods as A')
            ->select('A.reagent_id', 'B.reagent')
            ->join('reagents as B', 'A.reagent_id', '=', 'B.id')
            ->whereIn('A.testcode', $testCodes)
            ->get();

        // Extract unique reagent IDs if needed
        $uniqueReagentIds = $reagentDetails->pluck('reagent_id')->unique()->toArray();

        // Pass data to the view
        return view('user.show', [
            'assignTest' => $assignTest,
            'testCodes' => $testCodes,
            'subAssignTests' => $subAssignTests, // Add this line to pass subAssignTests to the view
            'lab_id' => $assignTest->lab_id,
            'prog_id' => $assignTest->prog_id,
            'instrument_id' => $assignTest->instrument_id,
            'assignTestId' => $assignTestId,
            'methodDetails' => $methodDetails,
            'reagentDetails' => $reagentDetails,
            'reagentId' => $uniqueReagentIds,
        ]);
    }


    public function store(Request $request, $assignTestId)
    {
        // Validate the form data
        $request->validate([
            'sampledate' => 'required|date',
            'results' => 'required|array',
            'results.*' => 'numeric', // Add any additional validation rules for results if needed
        ]);

        // Loop through the submitted results and store them in the entryresults table
        foreach ($request->input('results') as $testcode => $result) {
            EntryResult::create([
                'entry_id' => $assignTestId,
                'sampledate' => $request->input('sampledate'),
                'testcode' => $testcode,
                'result' => $result,
                'added_by' => auth()->user()->id,
                'update_by' => auth()->user()->id,
            ]);
        }

        // You may add additional logic or redirect the user to a different page after storing the data
        Session::flash('statuscode', 'success');
        return redirect()->route('result', ['assignTestId' => $assignTestId])->with('status', 'Entry Result Successfully');
    }

    public function result(Request $request, $assignTestId)
    {
        $assignTests = AssignTest::where('entry_id', $assignTestId)
            ->where('added_by', auth()->user()->id)
            ->with('test', 'method', 'unit', 'reagent')
            ->get();

        $entryResult = EntryResult::where('entry_id', $assignTestId)
            ->where('added_by', auth()->user()->id)
            ->firstOrFail();

        return view('user.result', compact('assignTests', 'entryResult'));
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
