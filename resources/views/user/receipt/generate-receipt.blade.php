<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Sample#{{ $entryresult->id }}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>
<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <img src="<?php echo $pic ?>" alt="AD Logo" height="60">
                    <img src="<?php echo $pic1 ?>" alt="ADEQA Logo" height="60">
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Sample ID: #{{ $entryresult->id }}</span> <br>
                    <span>Date: {{ date('d / m / Y')}}</span> <br>
                    <span>Address: 36, Jalan PJU 1A/13, Taman Perindustrian Jaya, 47301, Petaling Jaya, Selangor</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Data Details</th>
                <th width="50%" colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>ID:</td>
                <td>{{ $entryresult->id }}</td>

                <td>Sample Date:</td>
                <td>{{ $entryresult->sampledate }}</td>
            </tr>
            <tr>
                <td>Lab:</td>
                <td>{{ $entryresult->lab->labname}}</td>

                <td>Program:</td>
                <td>{{ $entryresult->program->programname}}</td>
            </tr>
            <tr>
                <td>Instrument:</td>
                <td>{{ $entryresult->instrument->instrumentname }}</td>

                <td>Reagent:</td>
                <td>{{ $entryresult->reagent->reagent }}</td>
            </tr>
            <tr>
                <td>Test:</td>
                <td>{{ $entryresult->test->testname }}</td>

                <td>Method:</td>
                <td>{{ $entryresult->method->methodname}}</td>
            </tr>
            <tr>
                <td>Unit:</td>
                <td>{{ $entryresult->unit->unit }}</td>

                <td>Result:</td>
                <td>{{ $entryresult->result }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Thank your for using ADEQA
    </p>

</body>
</html>
