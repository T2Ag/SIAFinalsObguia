<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Membership;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('first_name')->get();

        return view('Client/index',['clients' => $clients]);
    }

    public function create()
    {   
        $memberships = Membership::all();
        return view('Client/create',['memberships' => $memberships]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone' => 'nullable',
            'membership_id' => 'required'
        ]);

        Client::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'phone' => $request->phone,
            'membership_id' => $request->membership_id
        ]);

        return redirect('/clients')->with('info', 'A new Client has been added.');
    }

    public function edit(Client $client)
    {
        $memberships = Membership::all();
        return view('Client/edit', ['memberships' => $memberships], compact('client'));
    }

    public function update(Client $client, Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone' => 'nullable',
            'membership_id' => 'required'
        ]);

        $client -> update($request->all());

        return redirect('/clients')->with('info', "A Client with ID# $client->id has been updated.");
    }

    public function delete(Client $client)
    {
        $client->delete();

        return redirect('/clients')->with('info', "A Client with ID# $client->id has been deleted.");
    }

    public function generateCSV() {
        $clients = Client::orderBy('id')->get();

        $filename = '../storage/clients.csv';

        $file = fopen($filename, 'w+');
        
        fputcsv($file, ['First Name', 'Last Name', 'Address', 'Phone', 'Membership Type']);

        foreach ($clients as $client) {
            fputcsv($file, [
                $client->first_name,
                $client->last_name,
                $client->address,
                $client->phone,
                $client->membership_id,
            ]);
        }
        fclose($file);

        return response()->download($filename);
    }

    public function pdf() {
        $clients = Client::orderBy('id')->get();

        $pdf = Pdf::loadView('Client.pdf', compact('clients'));

        return $pdf->download('clients.pdf');
    }
    
    
    public function importCSV(Request $request)
    {
        try {
            $request->validate([
                'csv_file' => 'required|mimes:csv' // Validate the uploaded file
            ]);
    
            $file = $request->file('csv_file'); // Get the uploaded file
            $handle = fopen($file, 'r'); // Open the file for reading
    
            // Skip the header row
            fgetcsv($handle);
    
            // Loop through each row and create a new Customer instance
            while (($row = fgetcsv($handle)) !== false) {
                // Validate row data
                $validator = Validator::make([
                    'first_name' => $row[0] ?? null,
                    'last_name' => $row[1] ?? null,
                    'address' => $row[2] ?? null,
                    'phone' => $row[3] ?? null,
                    'membership_id' => $row[4] ?? null,
                ], [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'address' => 'required',
                    'phone' => 'required',
                    'membership_id' => 'required',
                ]);
    
                if ($validator->fails()) {
                    continue; // Skip invalid rows
                }
    
                // Create a new Customer instance and save it to the database
                Client::create([
                    'first_name' => $row[0],
                    'last_name' => $row[1],
                    'address' => $row[2],
                    'phone' => $row[3],
                    'membership_id' => $row[4],
                ]);
            }
    
            fclose($handle); 
    
            return redirect('/clients')->with('info', 'CSV file imported successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage()); 
        }
    }
        
}
