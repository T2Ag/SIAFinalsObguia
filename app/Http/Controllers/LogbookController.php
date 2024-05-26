<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Logbook;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LogbookController extends Controller
{
    public function index()
    {
        
        $logbooks = Logbook::orderBy('id', 'desc')->get();

        return view('logbook.index', ['logbooks' => $logbooks]);
    }

    public function create()
    {
        $clients = Client::all();
        return view('logbook.create', ['clients' => $clients]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id'
        ]);

        Logbook::create([
            'client_id' => $request->client_id
        ]);

        return redirect('/logbooks')->with('info', 'A new Logbook entry has been added.');
    }

    public function edit(Logbook $logbook)
    {
        $clients = Client::all();
        return view('logbook.edit', ['clients' => $clients], compact('logbook'));
    }

    public function update(Request $request, Logbook $logbook)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id'
        ]);

        $logbook->update($request->all());

        return redirect('/logbooks')->with('info', "Logbook entry with ID# $logbook->id has been updated.");
    }

    public function destroy($id)
    {
        $logbook = Logbook::find($id);
        if ($logbook) {
            $logbook->delete();
            return redirect('/logbooks')->with('success', 'Logbook deleted successfully');
        } else {
            return redirect('/logbooks')->with('error', 'Logbook not found');
        }
    }

    public function generateCSV()
    {
        $logbooks = Logbook::with('client')->orderBy('id')->get();

        $filename = storage_path('app/logbooks.csv');
        $file = fopen($filename, 'w+');

        fputcsv($file, ['Logbook ID', 'Client ID', 'Client Name', 'Created At']);

        foreach ($logbooks as $logbook) {
            fputcsv($file, [
                $logbook->id,
                $logbook->client_id,
                $logbook->client->first_name . ' ' . $logbook->client->last_name,
                $logbook->created_at
            ]);
        }
        fclose($file);

        return response()->download($filename);
    }

    public function pdf()
    {
        $logbooks = Logbook::with('client')->orderBy('id', 'desc')->get();

        $pdf = Pdf::loadView('logbook.pdf', compact('logbooks'));

        return $pdf->download('logbooks.pdf');
    }

    public function importCSV(Request $request)
    {
        try {
            $request->validate([
                'csv_file' => 'required|mimes:csv,txt'
            ]);

            $file = $request->file('csv_file');
            $handle = fopen($file, 'r');

            // Skip the header row
            fgetcsv($handle);

            while (($row = fgetcsv($handle)) !== false) {
                $validator = Validator::make([
                    'client_id' => $row[0] ?? null,
                ], [
                    'client_id' => 'required|exists:clients,id',
                ]);

                if ($validator->fails()) {
                    continue;
                }

                Logbook::create([
                    'client_id' => $row[0],
                ]);
            }

            fclose($handle);

            return redirect('/logbooks')->with('info', 'CSV file imported successfully.');
        } catch (\Exception $e) {
            return redirect('/logbooks')->with('error', $e->getMessage());
        }
    }

    public function scan(Request $request)
    {
        $clientId = $request->input('client_id');

        try {
            // Check if the client exists
            $client = Client::find($clientId);

            if (!$client) {
                return back()->with('error', 'Client does not exist');
            }

            // Create a new logbook entry
            Logbook::create([
                'client_id' => $clientId,
            ]);

            return redirect('/logbooks')->with('success', 'Logbook entry created');
        } catch (\Exception $e) {
            Log::error('Error creating logbook entry: ' . $e->getMessage());
            return redirect('/logbooks')->with('error', 'Internal Server Error');
        }
    }
}
