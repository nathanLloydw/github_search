<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class GithubController extends BaseController
{

    // the base url used to query the github API
    const BASE_URL = 'https://api.github.com';

    // a limit to how many results are returned to a query
    const LIMIT = 5;

    /**
     * @param $url
     */
    public function get_request($url)
    {
        $attempts = 0;

        // while less than 3 attempts has been made keep making the API request
        // un till we get a 200 response from the server.
        while($attempts < 3)
        {
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Accept: application/vnd.github.v3+json',
                'Authorization: token '.env("github_access_token"),
                'User-Agent: '.env("github_user")
            ]);

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);

            if($httpcode == 422)
            {
                return null;
            }
            else if($httpcode == 200)
            {
                return $response;
            }

            sleep(1);
            $attempts++;
        }

        return null;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function search_users(Request $request): string
    {
        // get the user to be search from the request.
        $search_user = $request->get('search_value');

        // replace all spaces with the html encoded version so it will work through the api request.
        $search_user = str_replace(' ', '%20', $search_user);

        $url = self::BASE_URL."/search/users?q=$search_user%20in:user:name&per_page=".self::LIMIT;

        $github_users = json_decode($this->get_request($url));

        foreach($github_users->items as $count => $github_user)
        {
            $user_repos = $this->get_users_top_x_repos($github_user->login,5);
            $github_users->items[$count]->repos = $user_repos;
        }

        return json_encode($github_users);
    }

    private function get_users_top_x_repos($username,$limit = self::LIMIT)
    {
        $url = self::BASE_URL."/search/repositories?q=user:$username%20in:user:name&per_page=".$limit;
        $repos = json_decode($this->get_request($url));

        if($repos)
            $repos = $repos->items;

        return $repos;
    }
}
