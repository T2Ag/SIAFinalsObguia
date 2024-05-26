@extends('layout')

@section('content')
    <div class="bg-white p-2 rounded shadow-sm">
        <h1 class="text-center create mb-5">Scan QR Here</h1>
        <div class="d-flex justify-content-center mb-2">
            <div id='reader' class="border rounded p-3 shadow-sm" style="width: 320px;"></div>
        </div>
        <div class="text-center">
            <label for="result" class="form-label fw-bold">ID Number:</label>
            <input type="text" name='result' id='result' class="form-control w-50 mx-auto" readonly>
        </div>
    </div>

    <script src='https://unpkg.com/html5-qrcode' type='text/javascript'></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Code matched = ${decodedText}`, decodedResult);
            document.getElementById('result').value = decodedText;
            alert("ID Number: " + decodedText); 
        }

        function onScanFailure(error) {
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 60, qrbox: 250 },
            false
        );
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection
