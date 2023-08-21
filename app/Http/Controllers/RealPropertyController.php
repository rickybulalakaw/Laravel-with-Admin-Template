<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RealProperty;
use Illuminate\Http\Request;
use App\Models\AccountableForm;
use Illuminate\Support\Facades\DB;
use App\Models\AccountableFormItem;
use App\Models\AccountableFormType;

class RealPropertyController extends Controller
{
    public function index ()
    {

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

        $collectors = User::get();

        $context = [
            'accountableFormTypesOfUser' => $accountable_form_types_of_user,
            'collectors' => $collectors
        ];
        return $context;
    }

    public function create (AccountableForm $accountableForm ) 
    {

        $context = $this->userContext();

        if($accountableForm->accountable_form_type_id != AccountableFormType::RPT_RECEIPT){
            return redirect()->route('userhome')->with('error', 'Parameter is not linked to a Real Property Tax Receipt');
        } 
        
        if ($accountableForm->use_status == AccountableForm::IS_ASSIGNED) {
            return redirect()->route('userhome')->with('error', 'Real Property Tax Receipt Payor is not yet saved');
        } elseif ($accountableForm->use_status == AccountableForm::IS_CANCELLED) {
            return redirect()->route('userhome')->with('error', 'Real Property Tax Receipt is cancelled');
        }

        // check if there is already record of real property table with this accountable form id 

        // Get a record from RealProperty where accountable_form_id = $accountableForm->id 

        $realProperty = RealProperty::where('accountable_form_id', $accountableForm->id)->first();

        if($realProperty){
            return redirect()->route('userhome')->with('error', 'Record/s for this Real Property Tax Receipt already registered');
        } 
        
        $realPropertyItems = AccountableFormItem::where('accountable_form_id', $accountableForm->id)->get();
        
        if($realPropertyItems->count() >=  1){
            return redirect()->route('userhome')->with('error', 'Record/s for this Real Property Tax Receipt already registered');
        }



        // 'receipt_no_pf_no_25',
        // 'period_covered',
        // 'classification',
        // 'tax_declaration_no',
        // 'barangay',
        // 'accountable_form_id'

        $context['accountable_form_id'] = $accountableForm->id;
        $context['accountableForm'] = $accountableForm;
        

        return view('accountableForm.create-rpt', $context);


    }

    public function store (Request $request)
    {

    }
}
