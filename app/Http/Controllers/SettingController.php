<?php

namespace App\Http\Controllers;

use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
use Milon\Barcode\Facades\DNS2DFacade as DNS2D;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\EmailTemplate;
use App\Models\Notification;

use View;


class SettingController extends Controller
{
   
    protected $Listnotifications;
    
    public function __construct()
    {
        $this->Listnotifications = Notification::latest()->take(8)->get();

        View::share('Listnotifications', $this->Listnotifications);
    }

    public function index()
    {
        $setting=SiteSetting::all();
        $logo='';
        $radius=0;
        foreach ($setting as $key => $value) {
            
            if($value->name=='logo'){
                $logo=$value->value;
            }
            if($value->name=='radius'){
                $radius=$value->value;
            }
           
        }
        return view('admin.setting.index',compact('logo','radius'));
    }
    public function updateSetting(Request $request)
    {

        // Validate the request data
        $request->validate([
  
            'site_logo' => 'nullable|image|max:2048'
        ]);

        // Update the site avatar, if provided
        if ($request->hasFile('site_logo')) {
            $avatar = $request->file('site_logo');
            $avatar_path = $avatar->store('site', 'public');
            // $user->avatar_path = $avatar_path;
        }
        $settings = SiteSetting::updateOrCreate(

            [
                'name' => 'logo',
            ],
            [
                'value' => $avatar_path,
            ]
         );
        $settings = SiteSetting::updateOrCreate(

            [
                'name' => 'radius',
            ],
            [
                'value' => $request->radius,
            ]
         );

   
        // Redirect the user back with a success message
        return redirect()->back()->with('success', 'Your settings has been updated successfully!');
   }

    public function getEmailTemplates(){

        $emails=EmailTemplate::all();
      
        return view('admin.emailTemp.index',compact('emails'));
    }

    public function templateDelete(Request $request){
        $request->validate([
            'id' => 'required',
            
        ]);

        $emails=EmailTemplate::find($request->id);
        $emails->delete();
        
        return response()->json([
            'success' => true,
            'data' => $emails
        ], 200);
    }
    public function createTemplate(Request $request){
        
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        $input=$request->all();
        $input['user_id']=auth()->user()->id;
        
        $emails=EmailTemplate::create($input);
      
        return response()->json([
            'success' => true,
            'data' => $emails
        ], 200);
    }
    public function editTemplate(Request $request){
        
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        $emails=EmailTemplate::find($request->id);
        $update=$emails->update($request->all());
        
        return response()->json([
            'success' => true,
            'data' => $emails
        ], 200);
    }
    // generate site barcode

    public function generateBarCode(Request $request)
    {
        $type='qrcode';
        $code='https://groominn.co/';
        if ($type == 'qrcode') {
            $barcode = DNS2D::getBarcodePNG($code, 'QRCODE');
        } else {
            $barcode = DNS1D::getBarcodePNG($code, $type);
        }

        return response($barcode, 200, [
            'Content-Type' => 'image/png'
        ]);
    }
}
