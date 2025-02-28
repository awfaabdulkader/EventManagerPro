<?php

namespace App\Http\Controllers\User;

use App\Models\FormTicket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormTicketRequest;
use App\Traits\FormTicketStoreTrait;
use Illuminate\Foundation\Http\FormRequest;

class DashboardController extends Controller
{
    use FormTicketStoreTrait;

    public function index()
    {
        $genderDistribution = [
            'Monsieur' => FormTicket::where('civility', 'Monsieur')->count(),
            'Madame' => FormTicket::where('civility', 'Madame')->count(),
        ];
        $organizations = FormTicket::selectRaw('organization, COUNT(*) as count')
        ->whereNotNull('organization')
        ->groupBy('organization')
        ->pluck('count', 'organization');


        $interests = FormTicket::selectRaw('job, COUNT(*) as count')
        ->groupBy('job')
        ->pluck('count', 'job');

        $users = FormTicket::paginate(10);

        return view('dashboard', compact('genderDistribution', 'organizations', 'interests' , 'users'));

    }

    public function showList()
    {
        $users = FormTicket::paginate(10);
        return view('TestA.list' , compact('users'));
    }

    public function create()
    {
        return view('Home');

    }


    public function edit(FormTicket $FormTicket)
    {
        return view('TestA.edit' , compact("FormTicket"));
    }

    public function update(FormTicketRequest $request , FormTicket $FormTicket)
    {
    
       $FormTicket->update($request->validated());
       return redirect()->route('dashboard/list')->with('success', 'Form updated successfully.');


    }


    public function destroy($id)
    {
        $user = FormTicket::findorFail($id);
        $user->delete();
      
        return redirect()->route('dashboard')->with('success', 'User deleted successfully');
    }

   
}
