<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DOMDocument;
use App\Models\LogHistory;
use Illuminate\Support\Facades\Http;
use App\Jobs\ProcessCSVData;
use Illuminate\Support\Facades\Bus;

class ScrepingController extends Controller
{
    public function index(Request $request){
       

        $htmlurl = 'https://poshmark.com/closet/jle4518';
        $dom = new DOMDocument();
        @$dom->loadHTMLFile($htmlurl);

        $data = $dom->getElementsByTagName('a');
        // dd($dom);
        foreach( $data as $p ) {
            // echo "<br/>".$p->textContent; // Print out content of <p> tags
            $urlData= "https://poshmark.com".$p->getAttribute('href'); // Print out attribute's <p> classes
            if($urlData == 'https://poshmark.com/login'){
                // echo  "hii";
                // $html = file_get_contents($urlData);
            }else{
                $html = file_get_contents($urlData);
            }

            //  $url=filter_var($html, FILTER_VALIDATE_URL);
             if(!empty($html)){
                $res = preg_match("/<title>(.*)<\/title>/siU", $html, $titleArray);
                $title = isset($titleArray[0]) ? $titleArray[0] : "";
                 $keyword = strip_tags($title);
                //  dd($keyword);
                if( empty($keyword)){
                    return response()->json(['sts' => false, 'errors' => ['Please Enter valid url !']]);
                }
             }else{
                   $keyword = $request->keyword;
             }
            //  $keyword ="my uk";
            $tone = "Good";
            $hash_tag_name = $request->hash_tag_name;
            if($hash_tag_name == 'true' || $hash_tag_name == 'True' || $hash_tag_name == 'TRUE'){
                $hash_tag_name ='True';
            }else{
                $hash_tag_name ='False';
            }
            // return $hash_tag_name;
            $word_size = 150;
            $hash_tag_name ='True';

            // $userData= UserDetails::where('user_id',$userId)->first();
        
            // $descriptionData= LogHistory::where('user_id',$userId)->get();
            // if($userData->credit > 0){
                   $response = Http::get('https://rewriter.depin.info/generate_new/'.$tone.'/'.$keyword.'/'.$hash_tag_name.'/'.$word_size.'');
                 $response = $response->json();
        
            // dd($response);
  
            $description    =   str_replace(".",".\r\n\r\n",$response['description']);
            if(!empty($response['hashtags'])){
            $hash_tag_name  =   $response['hashtags'];
            }else{
                $hash_tag_name  =   '';
            }
            $title          =   $response['title'];
            $dataHistory['user_id']=1;
            $dataHistory['tone']=$tone;
            $dataHistory['keyword']=$keyword;
            $dataHistory['description']=$description;
            $dataHistory['word_size']=$word_size ;
            $dataHistory['hash_tag_name']=$hash_tag_name;
            $dataHistory['title']=$title;

            $dataHistory['device_type'] = "web";
            // $dataHistory['signature']= $request->signature != '' ? $request->signature : '';
            $logHistory=LogHistory::create($dataHistory);

        }

            // $dataUser['credit']=  $userData->credit -1;
            // UserDetails::where('user_id',$logHistory->user_id)->update($dataUser);
            // $description = nl2br($description);
           return back();
            // }else{
            //     return response()->json(['sts' => false, 'errors' => ['Your creadit limit is over!']]);
        
    //   }

    }


}
