<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\Redirect;
use App\Models\SaftyQuestion;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * the main home page which is login Page for the app
     * @return view of the home page
     */
    public function home(){
        return Inertia::render('Auth/index',['title' => 'ارشيف سيارات الشرطة']);
    }
    
    /**
     * the Dashboard for the app
     * @return view of the Dashborad
     */
    public function dashboard(){
        return Inertia::render('Dashboard/index',['title' => 'لائحة التحكم']);
    }
    /**
     * get cerdentials and try to authenticate them if they true then redirect to authenticated route
     * if not it will return to the login page with error message
     * @return void  
     */
    public function login(Request $request){
        
        $ValidatedData=$request->validate([
            'username'=>'required',
            'password'=>'required|min:8'
        ]);
        
        return Auth::attempt($ValidatedData) ?
        redirect('/dashboard')->with('message', ['type' => 'success','text' => 'لقد تم تسجيل الدخول بنجاح']) :
        redirect('/')->with('message',['type' => 'error','text' => 'برجاء التاكد من اسم المستخدم وكلمة المرور']);
    }
    /**
     * get authenticated user and log him out then return to loginPage with success message.
     * @return boolean  
     */
    public function logout(Request $request){
        $user = auth()->logout();
        return redirect('/')->with('message', 
            ['type' => 'success','text' => 'لقد تم تسجيل الخروج بنجاح']
        );
    }
    /**
     * get random question and send it for the user.
     * @return view 
     */
    public function createSaftyQuestion(){
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
        // get random index from array $questions
        $key = array_rand($questiones);
    
        $saftyInfo=[
            "questions"=>$questiones,
            "key"=>$key
        ];
        return Inertia::render('Auth/create-saftyQuestion', [
            'title'     => 'سؤال الامان',
            'saftyInfo' => $saftyInfo
        ]);
    }
    /**
     * saveing the answer For User to used it later for reset Password.
     * @return redirect 
     */
    public function answerQuestion(Request $request)
    {
        $ValidatedData=$request->validate([
            'key'=>'required',
            'answer'=>'required'
        ]);

        $user=auth()->user();
        SaftyQuestion::create([
            'user_id'=>$user->id,
            'key'=>$ValidatedData['key'],
            'answer'=>$ValidatedData['answer']
        ]);

        return redirect('/dashboard')->with('message', 
                ['type' => 'success','text' => 'لقد تم تسجيل تسجيل اجابتك بنجاح']
            );
    }

    public function checkUserName(){
        return Inertia::render('Auth/checkUserName',['title' => 'تاكيد اسم المستخدم']);
    }

    public function confirmTheUserName(Request $request)
    {
        $ValidatedData=$request->validate([
            'username'=>'required'
        ]);

        $User=User::where($ValidatedData)->first();
        
        return $User ? redirect("/confirm-answer/{$User->id}") :
        redirect('/check-user-name')->with('message', ['type' => 'error','text' => 'برجاء التاكد من اسم المستخدم']);
       
    }

    public function confirmAnswerView(User $user){
        
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
        $key = $user->SaftyQuestion->key;

        $saftyInfo=[
            "questions"=>$questiones,
            "key"=>$key
        ];
        return Inertia::render('Auth/confirmAnswer',[
            'title' => 'تاكيد اجاية اسؤال',
            'type' => 'success',
            'text' => 'برجاء اجابة السؤال لتمكن من اعادة كلمة المرور',
            'saftyInfo' => $saftyInfo
        ]);
    }

    public function confirmTheAnswer(Request $request)
    {
        $ValidatedData=$request->validate([
            'key'=>'required',
            'answer'=>'required'
        ]);
        $saftyQuestion = SaftyQuestion::where($ValidatedData)->first();
        
        return $saftyQuestion ? redirect("/reset-password/{$saftyQuestion->user->id}") :
        redirect('/')->with('message', ['type' => 'error','text' => 'لقد قمت بكتابة اجابة خاطئه']);     
    }

    public function resetPasswordView(User $user){

        return Inertia::render('Auth/resetPassword',[
            'title' => 'إعادة كلمة المرور',
            'type' => 'success',
            'text' => 'برجاء إدخال كلمة المرور',
            'user' => $user->id
        ]);
    }

    public function resetpassword(Request $request, User $user){
        
        $ValidatedData=$request->validate([
            'password'=>'required|confirmed|min:6'
        ]);
        $user->password=bcrypt($ValidatedData['password']);
        $user->save();

        return redirect('/')->with('message', ['type' => 'success','text' => 'لقد تم إعادة تعين كلمة المرور']);
    }
}
