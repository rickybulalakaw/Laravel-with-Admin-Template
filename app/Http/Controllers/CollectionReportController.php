<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AccountableForm;
use Illuminate\Support\Facades\DB;

class CollectionReportController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    
    private function userContext(){
        $accountable_form_types_of_user = DB::table('accountable_form_types')
        ->join('accountable_forms', 'accountable_forms.accountable_form_type_id', '=', 'accountable_form_types.id')
        ->join('users', 'accountable_forms.user_id', '=', 'users.id')
        // ->select('accountable_form_types.name')->distinct()
        ->select('accountable_form_types.id', 'accountable_form_types.name')->distinct()
        ->where('users.id', auth()->user()->id)
        ->where('accountable_forms.use_status', AccountableForm::IS_ASSIGNED)
        ->get();

        // $collectors = User::where('status', User::STATUS_ACTIVE)->get();

        $collectors = User::where('function', '=', User::IS_COLLECTOR)->get();
        $context = [
            'accountable_form_types_of_user' => $accountable_form_types_of_user,
            'collectors' => $collectors
        ];
        
        return $context;
    }
    
    public function index () 
    {

    }

    public function draft ()
    {
        // This function displays the draft individual RCD of a collector 
        // This is limited to a person with function of collector 
        // By default, this displays the RCD of the individual for the date today 

        $context = $this->userContext();

        // dd($context);
        // $accountable_forms_for_draft = AccountableForm::with([ 'accountable_form_items'])
        // ->where('user_id', auth()->user()->id)
        // // with(['accountable_form_type'])
        // ->where('use_status', AccountableForm::IS_USED)
        // ->where('accounting_status', AccountableForm::IS_SUBMITTED)
        // ->where('form_date', date('Y-m-d'))
        // ->get();

        $accountable_forms_for_draft = DB::table('accountable_forms')
        ->join('accountable_form_types', 'accountable_forms.accountable_form_type_id', '=', 'accountable_form_types.id')
        ->join('accountable_form_items', 'accountable_forms.id', '=', 'accountable_form_items.accountable_form_id') 
        ->select('accountable_forms.id as form_id', 'accountable_forms.accountable_form_number as form_number', 'accountable_forms.form_date as form_date', 'accountable_forms.payor as payor', 'accountable_form_types.name as form_type', DB::raw('SUM(accountable_form_items.amount) AS total_amount'))
        // ->sum('accountable_form_items.amount','total_amount')
        ->groupBy('accountable_forms.id')
        ->where('accountable_forms.user_id', auth()->user()->id)
        ->where('accountable_forms.use_status', AccountableForm::IS_USED)
        ->where('accountable_forms.accounting_status', AccountableForm::IS_SUBMITTED)
        ->where('accountable_forms.form_date', date('Y-m-d'))
        ->orderBy('accountable_form_types.name', 'asc')
        ->get();

        if(count($accountable_forms_for_draft) < 1){
            return redirect()->route('userhome')->with('error', 'No draft RCD found for today');
        }
        // dd($accountable_forms_for_draft);

        $context['used_accountable_forms'] = $accountable_forms_for_draft;

        return view ('collectionReport.individual', $context);
    }

    public function submit ()
    {
        // This function is limited to today only
    }

    public function review (User $user) 
    {
        // This function displays the accountable forms of User
        // This is limited to a person with function of consolidator 

    }

    

}
