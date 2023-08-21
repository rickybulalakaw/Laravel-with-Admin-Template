<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RevenueType;
use Illuminate\Http\Request;
use App\Models\AccountableForm;
use Illuminate\Support\Facades\DB;
use App\Models\AccountableFormItem;
use App\Models\AccountableFormType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AccountableFormItemController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        
    }

    // private function userContext(){
    //     $accountable_form_types_of_user = DB::table('accountable_form_types')
    //     ->join('accountable_forms', 'accountable_forms.accountable_form_type_id', '=', 'accountable_form_types.id')
    //     ->join('users', 'accountable_forms.user_id', '=', 'users.id')
    //     // ->select('accountable_form_types.name')->distinct()
    //     ->select('accountable_form_types.id', 'accountable_form_types.name')->distinct()
    //     ->where('users.id', auth()->user()->id)
    //     ->where('accountable_forms.use_status', AccountableForm::IS_ASSIGNED)
    //     ->get();

    //     // $collectors = User::get();

    //     $context = [
    //         'accountableFormTypesOfUser' => $accountable_form_types_of_user,
    //         // 'collectors' => $collectors
    //     ];
    //     return $context;
    // }


    private function userContext(){


        
        $accountable_form_types_of_user = DB::table('accountable_form_types')
        ->join('accountable_forms', 'accountable_forms.accountable_form_type_id', '=', 'accountable_form_types.id')
        ->join('users', 'accountable_forms.user_id', '=', 'users.id')
        // ->select('accountable_form_types.name')->distinct()
        ->select('accountable_form_types.id', 'accountable_form_types.name')->distinct()
        ->where('accountable_forms.user_id', auth()->user()->id)
        ->where('accountable_forms.use_status', AccountableForm::IS_ASSIGNED)
        ->get();

        // $collectors = User::get();

        $context = [
            'accountable_form_types_of_user' => $accountable_form_types_of_user,
            // 'collectors' => $collectors
        ];
        return $context;
    
}

    public function index(AccountableForm $accountableForm) 
    {
        // This method shows details of the accountable form used, and input form for revenue types for entering amounts
        // dd ($accountableForm);
        $context = $this->userContext();

        // check that the accounting status is IS_SUBMITTED or IS_RETURNED
        $allowed_accounting_status = [
            AccountableForm::IS_SUBMITTED,
            AccountableForm::IS_RETURNED,
        ];

        // only the user_id of the accountable form can enter items 

        $thisUser = auth()->user()->id;

        if($thisUser != $accountableForm->user_id){
            abort(403, 'Unauthorized action.');
        }
        
        // get revenue types 
        $revenue_types = RevenueType::get();
        $accountable_form_items = AccountableFormItem::where('accountable_form_id', $accountableForm->id)->get();
        $accountableFormType = AccountableFormType::where('id', $accountableForm->accountable_form_type_id)->first();
        

        // dd($accountable_form_items);

        $context['accountableForm'] = $accountableForm;
        $context['revenue_types'] = $revenue_types;
        $context['accountableFormItemsOfForm'] = $accountable_form_items;
        $context['method'] = 'add-accountable-form-item';
        $context['accountable_form_type'] = $accountableFormType;

        return view('accountableForm.show', $context);

    }

    public function store ( AccountableForm $accountableForm, Request $request): RedirectResponse
    {
        // function that checks that the current user is authorized to create an accountable form item based on the accountable form id

        // $this->authorize('create', $accountableForm);

        // This function validates the input, then saves the data, then returns to accountable form function to enter additional items 
        $input = $this->validate($request, [
            // 'accountable_form_id' => 'required',
            'revenue_type_id' => 'required',
            'amount' => 'required'
        ],    
        [
            'revenue_type_id.required' => 'Please select a revenue type',
            'amount.required' => 'Please enter an amount'
        ]);

        AccountableFormItem::create( [
            'accountable_form_id' => $accountableForm->id,
            'revenue_type_id' => $input['revenue_type_id'],
            'amount' => $input['amount']
        ]);

        // redirect to accountable form 
        return redirect()->route('add-accountable-form-item', $accountableForm->id);

    }

    public function destroy (AccountableFormItem $accountableFormItem, Request $request)
    {

        $accountableFormItem->delete();

        return redirect()->route('add-accountable-form-item', $request->accountable_form_id)->with('success', 'Accountable Form Item Deleted');


    }
}
