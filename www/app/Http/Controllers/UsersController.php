<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{
    public function login(Request $request){
        
        $ValidatedData=$request->validate([
            'username'=>'required',
            'password'=>'required|min:8'
        ]);
        
        if(Auth::attempt($ValidatedData))
        {
            $user=Auth::user(); //AuthenticatedUser
            $user->ApiTokenGenerater(); // generate token
            return response()->json(['type'=>'success','message' => 'you have been login successfully','user'=>$user,'api_token'=> $user->api_token], 201);
        }
        else
        {
            return response()->json(['type'=>'error','message' => 'your credentials are wrong'], 400);
        }
    }
    
    public function logout(Request $request)
    {
        $user = auth('api')->user();
        if ($user) {
            $user->api_token = null;
            $user->save();
        }
        return response()->json(['type'=>'success','message' => 'User Logged Out.'], 200);
    }

    public function answerQuestion(Request $request)
    {
        $ValidatedData=$request->validate([
            'key'=>'required',
            'answer'=>'required'
        ]);

        $user=auth('api')->user();
        SaftyQuestion::create([
            'user_id'=>$user->id,
            'key'=>$ValidatedData['key'],
            'answer'=>$ValidatedData['answer']
        ]);

        return response()->json(['type'=>'success','message'=>'your saftyQuestion has been set'],201);
    }

    public function confirmTheUserName(Request $request)
    {
        $ValidatedData=$request->validate([
            'username'=>'required'
        ]);

        $User=User::where('username',$ValidatedData['username'])->first();
        
        if($User== true ){ 
            $questiones=[
                "ما هو رقم المنزل واسم الشارع الذي كنت تعيش فيه وانت طفل/طفله؟",
                "ما هي الأرقام الأربعة الأخيرة من رقم هاتفك؟",
                "ما المدرسة الابتدائية التي التحقت بها؟",
                "في أي  مدينة كانت أول وظيفة لك؟",
                "في أي مدينة أو مدينة تسكن حاليا؟",
                "ما هو اسم طفالك؟",
                "ما هي آخر خمسة أرقام من رقم رخصة القيادة/ البطاقة الخاصة بك؟",
                "ما هو اسم جدتك (على جانب والدتك)؟",
                "في أي مدينة يعيش اقرب اصدقائك؟",
                "ما هو تاريخ ميلاد طفلك؟",
                "ما هو تاريخ ميلادك؟"
            ];
            // get the key
            $key = $User->SaftyQuestion->key;
            $saftyInfo=[
                "question"=>$questiones,
                "key"=>$key
            ];
            $response=['type'=>'success','message'=>'Please Answer This Question','saftyInfo'=>$saftyInfo];
        }
        else{
            $response=['type'=>'error','message'=>'there is no username here for you!'];
        }
        
        return response()->json([$response], 200);
    }

    public function confirmTheAnswer(Request $request)
    {
        $ValidatedData=$request->validate([
            'key'=>'required',
            'answer'=>'required'
        ]);
        $saftyQ=SaftyQuestion::where(['key'=>$ValidatedData['key'],'answer'=>$ValidatedData['answer']])->first();
        
        $saftyQ== true ? $response=['type'=>'success','message'=>'reset your password!'] : $response=['type'=>'error','message'=>'your answer is wrong!'];
        
        return response()->json([$response], 200);
    }

    public function resetpassword(Request $request)
    {
        $ValidatedData=$request->validate([
            'username'=>'required',
            'password'=>'required|confirmed|min:6'
        ]);

        $User=User::where('username',$ValidatedData['username'])->first();
        $User->password=bcrypt($ValidatedData['password']);
        $User->save();

        return response()->json(['type'=>'success','message'=>'your password has been reset!'], 200);
    }
}
