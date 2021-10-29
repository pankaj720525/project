<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SearchType;
use App\Models\Subscription;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*Search Type Default Data*/
        $search_types_array[0]['name'] = 'Basic Search';
        $search_types_array[0]['slug'] = 'basic_search';
        $search_types_array[0]['description'] = 'Lorem ipsum dolor amet, consectetur adipiscing elit, sed do';
        $subscription[0]['stripe_price_id'] = 'price_1JMTDhSAAANuoucLLFXgEKRV';
        $subscription[1]['stripe_price_id'] = 'price_1JMTDhSAAANuoucLuwGrJinI';
        $subscription[2]['stripe_price_id'] = 'price_1JMTDhSAAANuoucLgBHVr9cJ';

        $search_types_array[1]['name'] = 'Needs Blog Content';
        $search_types_array[1]['slug'] = 'need_blog_content';
        $search_types_array[1]['description'] = 'Lorem ipsum dolor amet, consectetur adipiscing elit, sed do';

        $search_types_array[2]['name'] = 'Missing/Broken SSL';
        $search_types_array[2]['slug'] = 'missing_ssl';
        $search_types_array[2]['description'] = 'Lorem ipsum dolor amet, consectetur adipiscing elit, sed do';

        $search_types_array[3]['name'] = 'Needs SEO';
        $search_types_array[3]['slug'] = 'need_seo';
        $search_types_array[3]['description'] = 'Lorem ipsum dolor amet, consectetur adipiscing elit, sed do';

        $search_types_array[4]['name'] = 'Needs Analytics';
        $search_types_array[4]['slug'] = 'need_analytics';
        $search_types_array[4]['description'] = 'Lorem ipsum dolor amet, consectetur adipiscing elit, sed do';

        $search_types_array[5]['name'] = 'Needs Reviews';
        $search_types_array[5]['slug'] = 'need_reviews';
        $search_types_array[5]['description'] = 'Lorem ipsum dolor amet, consectetur adipiscing elit, sed do';

        $search_types_array[6]['name'] = 'Slow Website';
        $search_types_array[6]['slug'] = 'slow_website';
        $search_types_array[6]['description'] = 'Lorem ipsum dolor amet, consectetur adipiscing elit, sed do';

        $search_types_array[7]['name'] = 'Missing Schema';
        $search_types_array[7]['slug'] = 'missing_schema';
        $search_types_array[7]['description'] = 'Lorem ipsum dolor amet, consectetur adipiscing elit, sed do';

        foreach ($search_types_array as $value) {
            $add_search_type = SearchType::where('name',$value['name'])->first();
        	if(!$add_search_type){
        		$add_search_type = new SearchType;
        	}
            $add_search_type->name = $value['name'];
            $add_search_type->slug = $value['slug'];
            $add_search_type->description = $value['description'];
            $add_search_type->save();
        }

        /*Subscription Plan Data*/
        $subscription[0]['package_name'] = 'Starter';
        $subscription[0]['description'] = '50 searches per month';
        $subscription[0]['billing_period'] = 'month';
        $subscription[0]['billing_frequency'] = '1';
        $subscription[0]['price'] = 47;
        $subscription[0]['search_limit'] = 50;
        $subscription[0]['no_of_result'] = 20;

        $subscription[1]['package_name'] = 'Agency';
        $subscription[1]['description'] = '100 searches';
        $subscription[1]['billing_period'] = 'month';
        $subscription[1]['billing_frequency'] = '1';
        $subscription[1]['price'] = 97;
        $subscription[1]['search_limit'] = 100;
        $subscription[1]['no_of_result'] = 40;

        $subscription[2]['package_name'] = 'Lifetime (3 month )';
        $subscription[2]['description'] = '100 searches every month from lifetime';
        $subscription[2]['billing_period'] = 'lifetime';
        $subscription[2]['billing_frequency'] = '1';
        $subscription[2]['price'] = 297;
        $subscription[2]['search_limit'] = 100;
        $subscription[2]['no_of_result'] = 40;

        // Backup table
        \DB::statement('CREATE TABLE subscriptions_'.date('Ymd_His').' select * from subscriptions');
        Subscription::truncate();
        foreach ($subscription as $value) {
            $add_subscription = new Subscription;
            $add_subscription->package_name     = $value['package_name'];
            $add_subscription->description      = $value['description'];
            $add_subscription->billing_period   = $value['billing_period'];
            $add_subscription->billing_frequency    = $value['billing_frequency'];
            $add_subscription->stripe_price_id    = $value['stripe_price_id'];
            $add_subscription->price            = $value['price'];
            $add_subscription->search_limit = $value['search_limit'];
            $add_subscription->no_of_result = $value['no_of_result'];
            $add_subscription->save();
        }
    }
}
