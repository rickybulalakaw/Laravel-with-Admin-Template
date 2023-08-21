<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RevenueType;
use Illuminate\Http\Request;
use App\Models\AccountableForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class RevenueTypeController extends Controller
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

        // $collectors = User::get();

       

        $context = [
            'accountableFormTypesOfUser' => $accountable_form_types_of_user,
            // 'collectors' => $collectors
        ];
        return $context;
    }

    public function index () 
    {
        // this function lists all the revenue types

        $context = $this->userContext();
        $revenue_types = RevenueType::all();
        $context['revenue_types'] = $revenue_types;

        $headers = [
            ['class' => 'text-xl text-slate-800 dark:text-white', 'value' => 'Name'],
            ['class' => 'text-xl text-slate-800 dark:text-white', 'value' => 'Name for Column in Report'],
            ['class' => 'text-xl text-slate-800 dark:text-white', 'value' => 'Fund'],
        ];

        foreach($revenue_types as $rt){
            $rtd[] = [
                ['class' => 'border-b-2 border-yellow-500 dark:text-white dark:border-yellow-900', 'value' => $rt->single_display],
                ['class' => 'border-b-2 border-yellow-500 dark:text-white dark:border-yellow-900', 'value' => $rt->column_display],
                ['class' => 'border-b-2 border-yellow-500 dark:text-white dark:border-yellow-900 text-center', 'value' => $rt->fund],
            ];
        }

        $table_class = " w-full";

        $context['table_values'] = [
            'table_class' => $table_class,
            'tableheaders' => $headers,
            'tablebody' => $rtd,
        ];



        return view('revenueType.index', $context);
    }
    
    public function create(){

        if (! Gate::allows('admin', auth()->user()->id)) {
            abort(403, 'Unauthorized action.');
            // abort(403);
        }
        $context = $this->userContext();
        $funds = array(
            ['label' => 'General Fund', 'value' => RevenueType::FUND_100],
            ['label' => 'SEF', 'value' => RevenueType::FUND_200],
            ['label' => 'SEE', 'value' => RevenueType::FUND_300],
        );

        $context['funds'] = $funds;
        return view('revenueType.create', $context);
    }

    public function store (Request $request){

        // dd($request);

        // $context = $this->userContext();
        $this->validate($request, [
            'single_display' => 'required|max:255',
            'column_display' => 'required|max:255',
            'fund' => 'required',
            // 'number' => 'required|unique:accountable_form_types|max:255'            
        ]);

        RevenueType::create([
            'single_display' => $request->single_display,
            'column_display' => $request->column_display,
            'fund' => $request->fund,
            // 'number' => $request->number,
            // 'default_amount' => $request->default_amount
        ]);

        return redirect()->route('revenue-type-index')->with('success', 'Revenue Type Created');
    }
}
