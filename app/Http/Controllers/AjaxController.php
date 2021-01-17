<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session,Auth;
use App\Categorie;
use App\Project;
use App\User;
use App\Userprofile;
use App\Message;

class AjaxController extends Controller
{
    //


    public function index() {
        $msg = "This is a simple message.";
        return response()->json(array('msg'=> $msg), 200);
    }

    public function GetSubCategory(Request $request) {
        
        $data = '<ul class="">';
        if(isset($_GET['category_id']))
        {
            $parent_id = $_GET['category_id'];
            $subCategory = DB::table('categories')->where('parent_id', $parent_id)->get();
            
            foreach($subCategory as $row)
            {
                $title = preg_replace("/\r|\n/", "", $row->title);
                $title = str_replace(',','',$title);
                $seo_title = preg_replace("/\r|\n/", "", $row->seo_title);
                $seo_title = str_replace(',','',$seo_title);
                
                $data .= '<li> <input type="checkbox" id="'.$seo_title.'" onclick="addSubCategory('."'".$seo_title."'".','."'".$title."'".','."'".$row->id."'".')" />&nbsp; '.$row->title.' </li>';
            }

        }
            
        $data .= '</ul>';

        echo $data;

        //return response()->json(array('msg'=> json_encode($subCategory)), 200);
    }

    public function GetThanaByDistrict()
    {
        $data = '<option value="" > Area </option>';
        if(isset($_GET['district']))
        {
            $district = $_GET['district'];
            $areas = DB::table('locations')->where('district', $district)->orderBy('area','asc')->get();
            foreach($areas as $row)
            {
                $area = preg_replace("/\r|\n/", "", $row->area);
                $area = str_replace(',','',$area);            
                $data .= '<option value="'.$area.'" > '. ucfirst(strtolower($area)).' </option>';
            }
        }

        echo $data;
        
    }

    public function notificationSeen(Request $request)
    {        
        $notification_id = $request->notification_id;        
        DB::table('notifications')
                  ->where('id', $notification_id)
                  ->update(['status'=>1]);        
    }
    
}
