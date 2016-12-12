<?php

namespace App\Http\Controllers;

use App\AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Analytic;
use App\Post;
use App\AdditionalPost;
use App\DistrictName;
use Carbon\Carbon;
use DB;
use URL;
use Excel;
use App;
/*use Twilio;*/

class TestController extends Controller
{
    public function getPosts() {
        $fb = new \Facebook\Facebook([
            'app_id' => 'YOUR_FACEBOOK_APP_ID',
            'app_secret' => 'YOUR_APP_SECRET_KEY',
            'default_graph_version' => 'v2.8',
            //'default_access_token' => '{access-token}', // optional
        ]);


        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            // Start Date = 03/11/2016, // End Date = 03/13/2016
            $response = $fb->get('/YOUR_PROFILE_ID_NO/feed?limit=100&since=START_DATE&until=END_DATE&include_hidden=true', 'ACCESS_TOKEN');
            $value = json_decode($response->getBody());
            $messages = [];
            $ids = [];

            foreach ($value->data as $each_massage) {
                $messages[] = $each_massage->message;
                $ids[] = $each_massage->id;
            }

        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        return view('welcome', [
            'messages' => $messages,
            'ids' => $ids
        ]);
    }


    public function postComment(Request $request)
    {
        $message_post = $request['message_post'];

        $fb = new \Facebook\Facebook([
            'app_id' => 'YOUR_FACEBOOK_APP_ID',
            'app_secret' => 'YOUR_APP_SECRET_KEY',
            'default_graph_version' => 'v2.8',
            //'default_access_token' => '{access-token}', // optional
        ]);



        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            // Start Date = 03/11/2016, // End Date = 03/13/2016
            $response = $fb->get('/YOUR_PROFILE_ID_NO/feed?limit=100&since=START_DATE&until=END_DATE&include_hidden=true', 'ACCESS_TOKEN');
            $value = json_decode($response->getBody());
            $ids = [];
            $messages = [];

            foreach ($value->data as $each_massage) {
                $messages[] = $each_massage->message;
                $ids[] = $each_massage->id;
            }

        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }



        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            foreach ($ids as $id) {
                $response = $fb->post($id . '/comments', ['message' => $message_post], 'ACCESS_TOKEN');
            }


        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }


        return view('welcome', [
            'messages' => $messages,
            'ids' => $ids
        ]);

    }

}