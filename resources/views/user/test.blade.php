<?php
public function index(Request $request)
    {
        // Get lab_id, prog_id, reagent_id, and instrument_id from user input or any other source
        $inputLabId = $request->input('lab_id'); // Replace with the actual input name
        $inputProgId = $request->input('prog_id'); // Replace with the actual input name
        $inputReagentId = $request->input('reagent_id'); // Replace with the actual input name
        $inputInstrumentId = $request->input('instrument_id'); // Replace with the actual input name

        // Check if an AssignTest record exists with the provided conditions
        $assignTest = AssignTest::where([
            'lab_id' => $inputLabId,
            'prog_id' => $inputProgId,
            'reagent_id' => $inputReagentId,
            'instrument_id' => $inputInstrumentId,
        ])->first();

        // If a matching AssignTest is found, use its id; otherwise, use null
        $assignTestId = $assignTest ? $assignTest->id : null;

        // Fetch other data based on the obtained $assignTestId
        $entryResults = EntryResult::all();
        $assignTests = AssignTest::all();
        $methodDetails = Method::find($assignTestId);
        $reagents = Reagent::all();

        return view('user.entry-results', compact('entryResults', 'assignTests', 'assignTestId', 'methodDetails', 'reagents'));
    }
    <div class="mb-3 row">
                            <label for="instrument_id" class="col-sm-3 col-form-label">Instrument:</label>
                            <div class="col-sm-9">
                                @foreach($instruments as $inst)
                            <select name="instrument_id" class="form-control" id="instrument_id"  onchange="filter(this.value)">
                                    @if($inst->id == Request::get('instrument_id'))>
                                        <option selected="selected" value="{{ $instrument->id }}">{{ $instrument->instrumentname }}</option>
                                    @else
                                        <option value="{{ $inst->id }}">{{ $inst->instrumentname }}</option>
                                    @endif
                            </select>
                                @endforeach
                        </div>
                    </div>
