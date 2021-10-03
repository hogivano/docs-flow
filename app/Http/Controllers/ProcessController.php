<?php

namespace App\Http\Controllers;

use Auth;
use Storage;
use Session;
use App\Models\Submission;
use App\Models\Process;
use Illuminate\Support\Str;
use App\Models\ProcessActionUser;
use App\Models\ProcessAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function submitProcessAction(Request $request, $id) {
        foreach ($request->action_id as $actionId) {
            $processAction = ProcessAction::where('id', $actionId)->with('baseAction')->first();
            $value = '';
            //create user
            $checkActionUser = ProcessActionUser::where('process_action_id', $actionId)
                                ->where('submission_id', $id)->first();
            // return response()->json($request->all());
            if ($request->action_type[$actionId] == 'file') {
                if ($request->hasFile('action' . $id . $actionId)) {
                    //validate
                    $validator = Validator::make($request->all(), [
                        'action' . $id . $actionId . $actionId => 'max:5120', //5MB 
                    ]);

                    if ($validator->fails()) {
                        Session::flash('error', 'Ukuran file maksimal 5MB');
                        return redirect()->back();
                    }

                    $extension = strtolower($request->file('action' . $id . $actionId)->getClientOriginalExtension());
                    if (!in_array($extension, ['png', 'jpg', 'jpeg', 'txt', 'doc', 'docx', 'xls', 'xlxs', 'ppt', 'pdf'])) {
                        Session::flash('error', 'Format file tidak didukung');
                        return redirect()->back();
                    }
                    $loc = ($processAction->baseAction->location) ? $processAction->baseAction->location : 'file';

                    $nameFile = Str::random(4) . '-' . $request->file('action' . $id . $actionId)->getClientOriginalName();
                    $url = Storage::disk('public')->put($loc . '/' . $nameFile, file_get_contents($request['action' . $id . $actionId]));
                    $value = 'storage/' . $loc . '/' . $nameFile;

                    if ($checkActionUser) {
                        Storage::disk('public')->delete(str_replace('storage/', '', $checkActionUser->value));
                    }
                } else {
                    Session::flash('error', 'File tidak ditemukan!');
                    return redirect()->back();
                }
            } else if ($request->action_type[$actionId] == 'boolean') {
                $value = ($request->action) ? $request->action[$actionId] : '0';
            } else {
                $value = $request->action[$actionId];
            }
            
            if (!$checkActionUser) {
                $checkActionUser = ProcessActionUser::create([
                    'submission_id' => $id,
                    'user_id' => Auth::id(),
                    'process_action_id' => $actionId,
                    'value' => $value,
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id()
                ]);
            } else {
                ProcessActionUser::find($checkActionUser->id)->update([
                    'updated_by' => Auth::id(),
                    'value' => $value
                ]);
            }
        }
        Session::flash('success', 'Data berhasil disimpan!');
        return redirect()->back();
    }

    public function downloadFile($id) {
        $data = ProcessActionUser::where('id', $id)->first();

        if ($data) {
            if(!$data->value) {
                Session::flash('error', 'file tidak ditemukan');
                return redirect()->back();
            }

            return response()->download(storage_path($data->value));
        } else {
            Session::flash('error', 'file tidak ditemukan');
            return redirect()->back();
        }
    }
}
