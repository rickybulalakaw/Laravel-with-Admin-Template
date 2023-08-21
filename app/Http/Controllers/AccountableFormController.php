<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Message;
use App\Models\RevenueType;
use App\Models\CommunityTax;
use App\Models\RealProperty;
use Illuminate\Http\Request;
use App\Models\AccountableForm;
use Illuminate\Support\Facades\DB;
use App\Models\AccountableFormItem;
use App\Models\AccountableFormType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class AccountableFormController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

    }

    private function userContext(){


        
            $accountable_form_types_of_user = DB::table('accountable_form_types')
            ->join('accountable_forms', 'accountable_forms.accountable_form_type_id', '=', 'accountable_form_types.id')
            ->join('users', 'accountable_forms.user_id', '=', 'users.id')
            ->select('accountable_form_types.id', 'accountable_form_types.name')->distinct()
            ->where('accountable_forms.user_id', auth()->user()->id)
            ->where('accountable_forms.use_status', AccountableForm::IS_ASSIGNED)
            ->get();

            // get messages 

            $message_count = DB::table('messages')
            ->select('sender.first_name as first_name', 'sender.last_name as last_name', 'messages.subject as subject', 'messages.created_at as created_at')
            ->join('users as recipient', 'messages.recipient_user_id', '=', 'recipient.id')
            ->join('users as sender', 'messages.user_id', '=', 'sender.id')
            ->where('messages.recipient_user_id', auth()->user()->id)
            ->where('messages.status', Message::STATUS_UNREAD)
            ->count();

            $context = [
                'accountable_form_types_of_user' => $accountable_form_types_of_user,
                'message_count' => $message_count,
                // 'collectors' => $collectors
            ];
            return $context;
        
    }

    public function index() 
    {

        // $user = User::where('id', auth()->user()->id)->first();
        $context = $this->userContext();

        $dt = Carbon::now('Asia/Manila');

        // $dt = Carbon::createFromTime(13, 0, 0, 'Asia/Manila');

        // $context['time']  = $timeonepm->hour;

        if($dt->hour >= 13 && $dt->hour < 18){
            $greeting = "Good afternoon";
            
        } elseif($dt->hour == 12 ) {
            $greeting = "It's lunchtime";
        } elseif($dt->hour >= 18 && $dt->hour < 24) {
            $greeting = "Good evening";
            
        } else {
            $greeting = "Good morning";
        }

        $context['greeting'] = $greeting;
        $context['message'] = "";


        // dd($context);

        return view('accountableForm.index', $context); 
    }

    public function create()
    {
        // This function shows form for creating accountable forms for the collection staff to fill out
        // This function is limited to MTO Custodian of Accountable forms 
        // This function requires to identify start and ending accountable form numbers and user as accountable officer 
    
        // get list of users 
        if (! Gate::allows('admin', auth()->user()->id)) {
            abort(403);
        }

        $users = User::where('function', '=', User::IS_COLLECTOR)->get();

        $accountableFormTypes = AccountableFormType::get();
        $context = $this->userContext();
        $context['collectors'] = $users;
        $context['accountableFormTypes'] = $accountableFormTypes;
        $context['trigger'] = 'click';

        // return view('accountableForm.create', compact('users', 'accountableFormTypes', 'context'));
        return view('accountableForm.create', $context);
    }

    public function store (Request $request){

        // This function will create records of accountable forms based on input 
        // This function will loop creating records of accountable forms based on start and end numbers

        // dd ($request);
        $this->validate($request, [
            'accountable_form_type_id' => 'required',
            'collector' => 'required',  
            'start_number' => 'required',
            'end_number' => 'required',
        ],
        [
            'accountable_form_type_id.required' => 'Please select an accountable form type',
            'collector.required' => 'Please select a Collector',
            'start_number' => 'Select Start Number for Accountable Form',
            'end_number' => 'Select End Number for Accountable Form. This should be higher than the Start Number',
        ]
    );

        if($request->end_number <= $request->start_number){
            return back()->with('error', 'End number cannot be less than start number') ;
        }

        $start_number = $request->start_number;
        $end_number = $request->end_number;
        $accountable_form_type_id =  $request->accountable_form_type_id;
        $user_id = $request->collector;
        $use_status = AccountableForm::IS_ASSIGNED; 

        while($start_number <= $end_number){
            AccountableForm::create([
                'accountable_form_type_id' => $accountable_form_type_id,
                'user_id' => $user_id,
                'accountable_form_number' => $start_number,
                'use_status' => $use_status,
            ]);

            $start_number++;
        }

        return redirect()->route('create-accountable-form')->with('success', 'Accountable Forms created successfully') ;


    
    }

    public function record (AccountableFormType $accountableFormType){ 
        // function generates smallest number of accountable form based on type and current user 

        $user = auth()->user()->id;
        // $user = User::where('id', auth()->user()->id)->first();

        $context = $this->userContext();

        // get smallest number based on user assigned to user and accountable form type

        // return $accountableFormType;

        $accountableForm = AccountableForm::where('user_id', $user)->where('accountable_form_type_id', $accountableFormType->id)->where('use_status', AccountableForm::IS_ASSIGNED)->orderBy('accountable_form_number', 'asc')->first();

        if(!$accountableForm){
            return redirect()->route('userhome')->with('error', 'No available accountable form of this type is available for you.') ;
        } 

        $date_today = date("Y-m-d");

        if ($accountableFormType->id == AccountableFormType::OFFICIAL_RECEIPT)
        {
            $isOfficialReceipt = true;
        } else {
            $isOfficialReceipt = false;
        }

        $context['name'] = $accountableFormType->name;
        $context['id'] = $accountableFormType->id;
        $context['accountable_form_type_id'] = $accountableFormType->id;
        $context['accountable_form_id'] = $accountableForm->id;
        $context['isOfficialReceipt'] = $isOfficialReceipt;
        $context['accountable_form_number'] = $accountableForm->accountable_form_number;
        $context['date_today'] = $date_today;


        $ctc_id = [AccountableFormType::CTC_INDIVIDUAL, AccountableFormType::CTC_CORPORATION];
        if (in_array($accountableForm->accountable_form_type_id, $ctc_id)) { 
            $context['is_ctc'] = true;

            $ctc_a = RevenueType::CTC_A;
            $ctc_b = RevenueType::CTC_B;
            $ctc_c = RevenueType::CTC_C;
            $ctc_c1 = RevenueType::CTC_C1;

            $context['ctc_a'] = $ctc_a;
            $context['ctc_b'] = $ctc_b;
            $context['ctc_c'] = $ctc_c;
    
            $context['ctc_c1'] = $ctc_c1;

        } elseif($accountableForm->accountable_form_type_id == AccountableFormType::RPT_RECEIPT){
            $context['is_rpt_receipt'] = true;
            $land_classifications = array(
                ['value' => RealProperty::CLASS_AGRICULTURAL, 'label' => 'Agricultural'],
                ['value' => RealProperty::CLASS_RESIDENTIAL, 'label' => 'Residential'],
                ['value' => RealProperty::CLASS_COMMERCIAL, 'label' => 'Commercial']
            );

            $context['land_classifications'] = $land_classifications;
        } else {
            $context['regular_af'] = true;
        }



        $accountable_form_types_of_user = DB::table('accountable_form_types')
        ->join('accountable_forms', 'accountable_forms.accountable_form_type_id', '=', 'accountable_form_types.id')
        ->join('users', 'accountable_forms.user_id', '=', 'users.id')
        // ->select('accountable_form_types.name')->distinct()
        ->select('accountable_form_types.id', 'accountable_form_types.name')->distinct()
        ->where('accountable_forms.user_id', auth()->user()->id)
        ->where('accountable_forms.use_status', AccountableForm::IS_ASSIGNED)
        ->get();
        
        return view('accountableForm.record', 
                $context,
            );

    }

    public function fill (AccountableForm $accountableForm, Request $request){
        // AccountableFormType is submitted in request 

        // dd ($accountableForm);
        // dd($request);
        if($request->is_cancelled){
            $this->validate($request, [
                'form_date' => 'required'

            ]);

            $used_status = AccountableForm::IS_CANCELLED;
        } else {

            if (($request->accountable_form_type_id == AccountableFormType::CTC_INDIVIDUAL) || ($request->accountable_form_type_id == AccountableFormType::CTC_CORPORATION))
            {
                $input = $this->validate($request, [
                    'form_date' => 'required',
                    'payor' => 'required'
                ]);
            } elseif($request->accountable_form_type_id == AccountableFormType::RPT_RECEIPT) {

                $input = $this->validate($request, [
                    'form_date' => 'required',
                    'payor' => 'required',
                    'receipt_no_pf_no_25' => 'required',
                    'period_covered' => 'required',
                    'classification' => 'required',
                    'tax_declaration_no' => 'required'
                ]);

            } else {

                $input = $this->validate($request, [
                    'form_date' => 'required',
                    'payor' => 'required',
                ]);
            }

            $used_status = AccountableForm::IS_USED;
        }

        // DB::table('bills')->where('id', $bill->id)->update($updatedBill);
        DB::table('accountable_forms')->where('id', $request->accountable_form_id)->update([
            'form_date' => $request->form_date,
            'payor' => $request->payor,
            'use_status' => $used_status,
            'accounting_status' => AccountableForm::IS_SUBMITTED
        ]);

        if($used_status == AccountableForm::IS_CANCELLED){
            return redirect()->route('record-accountable-form', $request->accountable_form_type_id )->with('success', 'Accountable Form is cancelled') ;
        }

        

        // add logic depending on account form type or revenue type

        if(($request->accountable_form_type_id == AccountableFormType::CTC_INDIVIDUAL) || ($request->accountable_form_type_id == AccountableFormType::CTC_CORPORATION)){
            
            
            return redirect()->route('record-community-tax-individual', $request->accountable_form_id );

            // save data for items
            AccountableFormItem::create([
                'accountable_form_id' => $request->accountable_form_id,

            ]);
            // store the data for rpt table 

           

        } elseif($request->accountable_form_type_id == AccountableFormType::RPT_RECEIPT) { 

            RealProperty::create([
                'receipt_no_pf_no_25' => $input['receipt_no_pf_no_25'],
                'period_covered' => $input['period_covered'], 
                'classification' => $input['classification'],
                'tax_declaration_no' => $input['tax_declaration_no'],
                'barangay',
                'accountable_form_id' => $request->accountable_form_id,
            ]);

            // redirect to fill out form for RPT related fees

            // save data for items 


            AccountableFormItem::create([
                'accountable_form_id' => $request->accountable_form_id,
            ]);

            return redirect()->route('record-real-property-tax-receipt', $request->accountable_form_id ); 

        }else {
            // redirect to generic form to enter type of data one by one 
            return redirect()->route('add-accountable-form-item', $request->accountable_form_id);

        }

        // if no other data requirements, go to enter accountable form items linked to accountable form id 

        // return redirect()->route('show-accountable-form', $request->accountable_form_id );
    }


    public function show (AccountableForm $accountableForm){
        // This function will show the details of an accountable form that has been filled out 

        $required_status = AccountableForm::IS_USED;

        if($accountableForm->use_status !== $required_status){
            return redirect()->route('userhome')->with('error', 'This Accountable Form is not used') ;
        }

        $disallowed_types = [
            AccountableFormType::CTC_CORPORATION,
            // AccountableFormType::CTC_INDIVIDUAL,
            AccountableFormType::RPT_RECEIPT
        ];
        
        if(in_array($accountableForm->accountable_form_type_id, $disallowed_types)){
            return redirect()->route('userhome')->with('error', 'Invalid parameter entered');
        }

        $accountableFormItems = AccountableFormItem::with(['revenue_type'])->where('accountable_form_id', $accountableForm->id)->get();
        // AccountableFormItem::where('accountable_form_id', $accountableForm->id)->get();

        $accountableFormType = AccountableFormType::where('id', $accountableForm->accountable_form_type_id)->first();
        
        $context = $this->userContext();
        $context['accountableFormItemsOfForm'] = $accountableFormItems;
        $context['accountableForm'] = $accountableForm;
        $context['accountable_form_type'] = $accountableFormType;
        $context['method'] = 'show';

        // dd($accountableFormItems);
        // dd($data);
        // show details  of accountable form

        return view('accountableForm.show', $context);


        // get accountable form items linked to accountable form id

    }

    public function review (AccountableForm $accountableForm){
        // This function will show the details of an accountable form that has been filled out 
        // this allows comment by consolidator / approver

        $required_status = AccountableForm::IS_USED;

        if($accountableForm->use_status !== $required_status){
            return redirect()->route('userhome')->with('error', 'This Accountable Form is not used') ;
        }

        $disallowed_types = [
            AccountableFormType::CTC_CORPORATION,
            AccountableFormType::CTC_INDIVIDUAL,
            // AccountableFormType::RPT_RECEIPT
        ];
        
        if(in_array($accountableForm->accountable_form_type_id, $disallowed_types)){
            return redirect()->route('userhome')->with('error', 'Invalid parameter entered');
        }

        $accountableFormItems = AccountableFormItem::with(['revenue_type'])->where('accountable_form_id', $accountableForm->id)->get();
        
        $accountableFormType = AccountableFormType::where('id', $accountableForm->accountable_form_type_id)->first();

        $formComments = Comment::with(['user'])->where('accountable_form_id', $accountableForm->id)->orderBy('created_at', 'desc')->get();
        
        


        $context = $this->userContext();
        $context['accountableFormItemsOfForm'] = $accountableFormItems;
        $context['accountableForm'] = $accountableForm;
        $context['method'] = 'review-accountable-form';
        $context['accountable_form_type'] = $accountableFormType;
        $context['comments'] = $formComments;


        return view('accountableForm.show', $context);


        // get accountable form items linked to accountable form id

    }


    public function endorse (AccountableForm $accountableForm, Request $request)
    {
        // This function is used by a consolidator 
        // This function will change the status of an accountable form from IS_USED to IS_REVIEWED_CONSOLIDATOR

        $accountableForm->accounting_status = AccountableForm::IS_REVIEWED_CONSOLIDATOR;

        $accountableForm->save();

        // return to previous page 
        return redirect()->route('review-accountable-form', $accountableForm->id)->with('success', 'Accountable Form status updated')  ;        

    }
    public function edit (AccountableForm $accountableForm)
    {

    }

    public function update (AccountableForm $accountableForm) 
    {
    
    }

    public function userDraft () 
    {
        // This function will show list of accountable forms of current user for this date 

        return "My accountable Forms submitted today";

        $context = $this->userContext();

        return view('accountableForm.report', $context);

    }

    public function destroy (AccountableForm $accountableForm) 
    {

        // function nullifies an accountable form 

        // loops all accountable form items and nullifies them 
    
    }


    public function dashboard() 
    {
        return view('pages.dashboard.dashboard');
    }

}
