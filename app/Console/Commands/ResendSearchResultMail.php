<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CampaignsMaster;
use App\Models\CampaignDetail;

class ResendSearchResultMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resend:searchresultmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run this cron every 5 minutes. If any searching mail not send due to some reason this cron are set to resend this mail to user.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Cron start successfully');

        $campaign_masters = CampaignsMaster::with('user:id,email,name')
        ->where('is_mail_result',1)
        ->where('status',1)
        ->where('is_delete',0)
        ->whereIn('isEmailSent',[0,2])
        ->get();

        foreach ($campaign_masters as $key => $campaign_master) {
            if(!empty($campaign_master->user)){
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

                    $campaign_master->isEmailSent = 1;
                    $campaign_master->save();

                }catch(Exception $e){
                    print_r($e);
                }
            }
        }

        $this->info('Cron end successfully');
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
            $exportData = [ 'No' => $key+1,
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
