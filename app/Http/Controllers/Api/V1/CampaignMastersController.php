<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\CampaignsMaster;
use App\Models\CampaignDetail;

class CampaignMastersController extends Controller
{
    public function sendResultEmail(Request $request){
    	
    	if(!$request->has('campaign_id') || empty($request->campaign_id)){
            return response()->json(['status' => 401, 'success'=> false, 'message' => 'Campaign Id is required.']);
    	}

    	$campaign_master = CampaignsMaster::with('user:id,email,name')
    	->where('id',$request->campaign_id)
    	->where('status',1)
        ->where('is_mail_result',1)
    	->where('is_delete',0)
    	->first();

    	if($campaign_master){

	        $data['email'] = $campaign_master->user->email;
	        $data['title'] = "Legiit Leads | Search Completed";
	        $data['content'] = "<h1>Your search has been finished.</h1><br> Please check attachement";
	        $data['id'] = $campaign_master->id;

	        try{
		        \Mail::send('mails.seach_result_complete', $data, function($message)use($data) {
		            $message->to($data["email"], $data["email"])
		                    ->subject($data["title"]);
                    $message->attachData($this->createCSV($data['id']), "SearchResult.csv");;

		        });
                return response()->json(['status' => 200, 'success'=> true, 'message' => 'Mail sent successfully.']);
		    }catch(Exception $e){
            	return response()->json(['status' => 401, 'success'=> false, 'message' => 'Something went wrong. Main not send']);
		    }
        	
    	}else{
            return response()->json(['status' => 401, 'success'=> false, 'message' => 'Record not found.']);
    	}
    }

    public function createCSV($id)
    {
    	$campaigns = CampaignDetail::select('campaign_details.*','search_types.name as search_type')
	        ->where('campaign_id',$id)
	        ->where('campaign_details.is_delete',0)
	        ->join('search_types', 'search_types.id', '=', 'campaign_details.search_type_id')
	        ->get();

    	header('Content-Type: text/csv; charset=utf-8');
    	//header without attachment; this instructs the function not to download the csv
    	header("Content-Disposition: filename=myCsvFile.csv");
    	//Temporarily open a file and store it in a temp file using php's wrapper function php://temp. You can also use php://memory but I prefered temp.
    	$Myfile = fopen('php://temp', 'w');

    	//state headers / column names for the csv
    	$headers = array('No','Search Type','Name','Keywords','Email','Phone','Website','Location','Created Date');
    	//write the headers to the opened file
    	fputcsv($Myfile, $headers);
    	//parse data to get rows
    	foreach ($campaigns as $key => $value) {
            $exportData = [	'No' => $key+1,
            				'Search Type' => $value->search_type,
            				'Name' => $value->name,
            				'Keywords' => $value->keywords,
            				'Email' => $value->email,
            				'Phone' => $value->phone,
            				'Website' => $value->website,
            				'Location' => $value->city,
            				'Created Date' => date('Y-m-d H:i:s',strtotime($value->created_at))];
        	//write the data to the opened file;
    		fputcsv($Myfile, $exportData);
        }
    	//rewind is a php function that sets the pointer at begining of the file to handle the streams of data
    	rewind($Myfile);
    	//stream the data to Myfile
    	return stream_get_contents($Myfile);
    }
}
