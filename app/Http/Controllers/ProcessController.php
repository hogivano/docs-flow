<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Process;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    //

    public function changeOrder(Request $request) {
        $index = 1;
        $application_id = '';
        
        foreach ($request->process_id as $id) {
            $process = Process::where('id', $id)->first();
            $process->order = $index;
            $process->save();

            $application_id = $process->application_id;
            $index++;
        }
        Session::flash('success', 'Berhasil dirubah urutannya');
        return redirect()->route('application.detail', ['id' => $application_id]);
    }
}
