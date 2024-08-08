<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use App\Models\Event;

class PDFController extends Controller
{
    public function generate (Request $request)
    {
        $event = Event::findOrFail($eventId);

        $pdf = new Fpdi();

        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 16);

        
        $pdf->Cell(0, 10, 'Certificate of Attendance', 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'This certifies that', 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->Cell(0, 10, 'John Doe', 0, 1, 'C'); // Replace with actual participant name
        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'has participated in the event', 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->Cell(0, 10, $event->activity_title, 0, 1, 'C'); // Use event name from the database
        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'held on ' . $event->activity_start_date, 0, 1, 'C'); // Use event date from the database

        
        $pdf->Output('certificate.pdf', 'D');
    }
}
