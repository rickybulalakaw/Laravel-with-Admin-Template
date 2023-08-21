<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RevenueType;
use Illuminate\Http\Request;
use App\Models\AccountableForm;
use Illuminate\Support\Facades\DB;
use App\Models\AccountableFormItem;
use App\Models\AccountableFormType;

class CommunityTaxController extends Controller
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


    public function index() 
    {

    }

    public function createIndividual (AccountableForm $accountableForm) 
    {
        // dd ($accountableForm);

        $allowed_types = [
            AccountableFormType::CTC_CORPORATION,
            AccountableFormType::CTC_INDIVIDUAL
        ];
        
        if(!in_array($accountableForm->accountable_form_type_id, $allowed_types)){
            return redirect()->route('userhome')->with('error', 'Invalid parameter submitted');
        }

        $ctc_a = RevenueType::CTC_A;
        $ctc_b = RevenueType::CTC_B;
        $ctc_c = RevenueType::CTC_C;
        $ctc_c1 = RevenueType::CTC_C1;

        $context = $this->userContext();
        $context['accountable_form_id'] = $accountableForm->id;
        $context['ctc_a'] = $ctc_a;
        $context['ctc_b'] = $ctc_b;
        $context['ctc_c'] = $ctc_c;

        $context['ctc_c1'] = $ctc_c1;
        $context['accountable_form_type_id'] = $accountableForm->accountable_form_type_id;
        return view('accountableForm.create-ctc', $context);
    }

    public function storeIndividual (Request $request) 
    {

        // dd ($request->post(RevenueType::CTC_A));
        $this->validate($request, [
            'is_reviewed' => 'required'
        ]);

        AccountableFormItem::create([
            'accountable_form_id' => $request->accountable_form_id,
            'amount' => $request->post(RevenueType::CTC_A),
            'revenue_type_id' => RevenueType::CTC_A
        ]);
        AccountableFormItem::create([
            'accountable_form_id' => $request->accountable_form_id,
            'amount' => $request->post(RevenueType::CTC_B),
            'revenue_type_id' => RevenueType::CTC_B
        ]);
        AccountableFormItem::create([
            'accountable_form_id' => $request->accountable_form_id,
            'amount' => $request->post(RevenueType::CTC_C),
            'revenue_type_id' => RevenueType::CTC_C
        ]);
        AccountableFormItem::create([
            'accountable_form_id' => $request->accountable_form_id,
            'amount' => $request->post(RevenueType::CTC_C1),
            'revenue_type_id' => RevenueType::CTC_C1
        ]);

        return redirect()->route('userhome')->with('success', 'CTC Payment Successfully Recorded') ;
        // return redirect()->route('record-accountable-form', $request->accountable_form_id)->with('success', 'CTC Payment Successfully Recorded') ;



    }
}
