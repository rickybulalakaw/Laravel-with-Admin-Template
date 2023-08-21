<?php



    namespace App\Http\Controllers;
    use App\Models\Message;
    use App\Models\AccountableForm;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Http;
    use App\Models\DataFeed;
    use Carbon\Carbon;

    class DashboardController extends Controller
    {

        /**
         * Displays the dashboard screen
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
         */


         
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

            $context= $this->userContext();
            $dataFeed = new DataFeed();

            return view('pages/dashboard/dashboard',
             compact('dataFeed')
            
            );
        }
    }
