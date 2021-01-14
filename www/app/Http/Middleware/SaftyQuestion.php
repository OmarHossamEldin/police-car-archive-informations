<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class SaftyQuestion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user =auth('api')->user();

        if($user->SaftyQuestion)
        {
            return $next($request);
        }
        else
        {
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
                "question"=>$questiones,
                "key"=>$key
            ];
            return response(['type'=>'Warning','message' => 'Your Have to Asnswer Safty Question','saftyInfo'=>$saftyInfo],200);
        }
    }
}
