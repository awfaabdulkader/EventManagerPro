<?php

namespace App\Http\Controllers;

use Log;
use App\Models\FormTicket;
use App\Mail\InvitationMail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Traits\FormTicketStoreTrait;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\FormTicketRequest;
use Illuminate\Support\Facades\Response;

class FormTicketController extends Controller
{
    use FormTicketStoreTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Home');

    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function thanks()
{
    return view('thanks'); // This should match the Blade file name
}
    /**
     * Display the specified resource.
     */
    public function show(FormTicket $formTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormTicket $formTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FormTicket $formTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormTicket $formTicket)
    {
        //
    }

 // app/Http/Controllers/DashboardController.php

     private function getData()
     {
         return [
             'gender' => FormTicket::selectRaw("civility as category, COUNT(*) as value")
                                   ->groupBy('civility')
                                   ->get(),

 
             'organizations' => FormTicket::selectRaw("organization as name, COUNT(*) as count")
                                          ->whereNotNull('organization')
                                          ->groupBy('organization')
                                          ->get(),
 
             'interests' => FormTicket::selectRaw("job as name, COUNT(*) as count")
                                      ->groupBy('job')
                                      ->get()
         ];
     }
 


     public function exportPDF()
     {
         $data = $this->getData();
     
         // Convert collections to arrays
         $data['gender'] = $data['gender']->toArray();
         $data['organizations'] = $data['organizations']->toArray();
         $data['interests'] = $data['interests']->toArray();
     
         // Debug to check data before rendering
         // dd($data);
     
         $pdf = Pdf::loadView('exports.data-pdf', compact('data'));
     
         return $pdf->download('dashboard-data.pdf');
     }
     

     public function exportCsv()
{
    $data = [
        'gender' => FormTicket::selectRaw("civility as category, COUNT(*) as value")
                              ->groupBy('civility')
                              ->get()
                              ->toArray(),

        'organizations' => FormTicket::selectRaw("organization as name, COUNT(*) as count")
                                     ->whereNotNull('organization')
                                     ->groupBy('organization')
                                     ->get()
                                     ->toArray(),

        'interests' => FormTicket::selectRaw("job as name, COUNT(*) as count")
                                 ->groupBy('job')
                                 ->get()
                                 ->toArray()
    ];

    $output = fopen('php://temp', 'r+');

    // Headers
    fputcsv($output, ['Type', 'Category', 'Value', 'Organization', 'Interest']);

    // Gender data
    foreach ($data['gender'] as $item) {
        fputcsv($output, [
            'Gender',
            $item['category'],
            $item['value'],
            '',
            ''
        ]);
    }

    // Organizations data
    foreach ($data['organizations'] as $item) {
        fputcsv($output, [
            'Organization',
            '',
            $item['count'],
            $item['name'],
            ''
        ]);
    }

    // Interests data
    foreach ($data['interests'] as $item) {
        fputcsv($output, [
            'Interest',
            '',
            $item['count'],
            '',
            $item['name']
        ]);
    }

    rewind($output);
    $csvData = stream_get_contents($output);
    fclose($output);

    return response($csvData)
        ->header('Content-Type', 'text/csv')
        ->header('Content-Disposition', 'attachment; filename="dashboard-data.csv"');
}

// New function for exporting PDF
public function generateFormTicketsPDF()
{
    $data = FormTicket::all(); // Get all form tickets

    $pdf = Pdf::setPaper('a4', 'landscape')->loadView('exports.alldata', compact('data'));
    return $pdf->download('new_form_tickets.pdf');
}

// New function for exporting CSV
public function generateFormTicketsCSV()
{
    $fileName = 'new_form_tickets.csv';
    $formTickets = FormTicket::all();

    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    ];

    $handle = fopen('php://output', 'w');
    // Add column headers
    fputcsv($handle, ['ID', 'Civility', 'First Name', 'Last Name', 'Organization', 'Email', 'Phone', 'Job', 'Created At']);

    // Add rows
    foreach ($formTickets as $ticket) {
        fputcsv($handle, [
            $ticket->id,
            $ticket->civility,
            $ticket->firstName,
            $ticket->lastName,
            $ticket->organization ?? 'N/A',
            $ticket->email,
            $ticket->phone,
            $ticket->job,
            $ticket->created_at
        ]);
    }

    fclose($handle);

    return Response::make('', 200, $headers);
}

 }
 

