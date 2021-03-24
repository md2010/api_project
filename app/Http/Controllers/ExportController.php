<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Filters\UserFilter;
use Iluminate\Databse\Query\Builder;
use Illuminate\Support\Facades\Cache;
use App\Exports\UsersExport;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\FileSending;
use PDF;
use App\Jobs\SendExportFile;

class ExportController extends Controller
{
    public function exportCSV(Request $request, UserFilter $filters)
    {
        if(! $this->checkCache()) {
            return  response()->format('You can not export twice in a minute.', null, null);
        } 

        $users = User::filter($filters)->get();
        $fileName = 'users.csv';
        $fullPath = public_path($fileName);  //saves in app/public
        $file = Excel::store(new UsersExport($users), $fileName, 'public');

        //Mail::to(auth()->user()->email)->send(new FileSending($fullPath));
        SendExportFile::dispatch($fullPath);
        
        return response()->format('File has been sent to your email!', null, null);
    }

    public function exportPDF(Request $request, UserFilter $filters)
    {
        if(! $this->checkCache()) {
            return  response()->format('You can not export now.', null, null);
        }

        $users = User::filter($filters)->get();
        $fileName = 'users.pdf';
        $fullPath = public_path($fileName);
        $pdf = PDF::loadView('pdf_content', compact('users'));
        $file = $pdf->save($fullPath);     
        
        Mail::to(auth()->user()->email)->send(new FileSending($fullPath));
        
        return response()->format('File has been sent to your email!', null, null);
    }

    public function exportCSV2(Request $request, UserFilter $filters)
    {
        if(! $this->checkCache()) {
            return  response()->format('You can not export now.', null, null);
        }

        $users = User::filter($filters)->get()->toArray();       
        $fileName = 'users.csv';
        $fullPath = public_path($fileName);
        $fp = fopen('users.csv', 'w');

        foreach($users as $user) {
            fputcsv($fp, $user);
        }
        fclose($fp);

        Mail::to(auth()->user()->email)->send(new FileSending($fullPath));
        
        return response()->format('File has been sent to your email!', null, null);
    }

    public function checkCache()
    {
        if(Cache::has(auth()->user()->id)) {
            return false;
        } else {
            Cache::put(auth()->user()->id, 'user_id', now()->addMinutes(1));
            return true;
        }
    }

}
