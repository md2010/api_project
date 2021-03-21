<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Filters\UserFilter;
use Iluminate\Databse\Query\Builder;
use App\Exports\UsersExport;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\FileSending;
use PDF;

class ExportController extends Controller
{
    protected $filePath = 'C:\xampp\htdocs\authorizationAPI\storage\app';

    public function exportCSV(Request $request, UserFilter $filters)
    {
        $users = User::filter($filters)->get();

        $fileName = 'users.csv';
        $file = Excel::store(new UsersExport($users), $fileName);
        
        $fullPath = $this->filePath.'\\'.$fileName;
        Mail::to(auth()->user()->email)->send(new FileSending($fullPath));
        
        return response()->format('File has been sent to your email!', null, null);
    }

    public function exportPDF(Request $request, UserFilter $filters)
    {
        $users = User::filter($filters)->get();

        $fileName = 'users.pdf';
        $fullPath = $this->filePath.'\\'.$fileName;
        $pdf = PDF::loadView('pdf_content', compact('users'));
        $file = $pdf->save($fullPath);     
        
        Mail::to(auth()->user()->email)->send(new FileSending($fullPath));
        
        return response()->format('File has been sent to your email!', null, null);
    }

}
