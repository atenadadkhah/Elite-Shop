<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Profiles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected  $media;
    protected int $userID;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->userID = Auth::user()->id;
            return $next($request);
        });

    }

    public function setMedia(): string
    {
        $this->media = User::find($this->userID)->getmedia('avatars');
        $this->media = $this->media->count() ? $this->media[0]->getFullUrl() : 'https://res.cloudinary.com/atenad/image/upload/user.webp';
        return $this->media;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('/dashboard', ['media' => self::setMedia()]);
    }

    public function profileDetails()
    {

        return view('profile-details', ['media' => self::setMedia()]);
    }

    public function getOrders()
    {
        return view('order');
    }

    public function editProfile(Request $request){
        $user = Auth::user()->id;
        $validator = Validator::make($request->all(),[
            'avatar' => 'filled|file|image|between:1,2048|dimensions:min_width=100,min_height=100',
            'about' => 'nullable|min:5,max:1000',
            'fullName'=>['required','regex:/^[a-zA-Zالف-ی]{2,}(?:\s[a-zA-Zالف-ی]+)+$/','max:50'],
            'userName'=>'required|regex:/^(?=.*[الف-یA-Za-z])[الف-یA-Z0-9a-z-_.]{1,50}$/',
            'city' => 'nullable|alpha|min:2',
            'phone' =>['nullable','regex:/(09)[0-9]{9}/',Rule::unique('profiles')->ignore($user,'user_id')],
            'birth' => ['nullable','date','after_or_equal:1 January 1920','before_or_equal:1 January 2020']
        ]);
        if ($validator->fails()){
            return response()->json(['errors'=>$validator->errors()],422);
        }
        $avatar = $request->file('avatar') ?? null;
        if ($avatar){
            User::find(Auth::user()->id)->clearMediaCollection('avatars');
            User::find(Auth::user()->id)
                ->addMedia($request->file('avatar')->getRealPath())
                ->usingFileName(hash('xxh3', microtime()))
                ->toMediaCollection('avatars', 'cloudinary');
        }

        date_default_timezone_set('Asia/Tehran');

        User::where('id',$user)->update([
            'username' => $request->userName,
            'name' => $request->fullName,
            'updated_at' => date('Y-m-d h:i:s', time())
        ]);
        $profile = [
            'about' => $request->about,
            'country' => $request->city,
            'phone' => $request->phone,
            'birth' => $request->birth
        ];
        Profiles::where('user_id',$user)->update($profile);
    }
}
