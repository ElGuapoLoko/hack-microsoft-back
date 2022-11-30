<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function __construct()
    {
        $this->clientKey = "3247cb085ea21b1bfb9364437302d9ab34a037c38d3181fadee61bed38fbb963";
    }

    public function index(Request $request)
    {
        $url = "https://dev.eduplay.rnp.br/services/video";

        $relevantes = $this->requestEduplay($url, null, 'GET', "?limit=50&order=0");
        $curtidos = $this->requestEduplay($url, null, 'GET', "?limit=50&order=1");
        $vistos = $this->requestEduplay($url, null, 'GET', "?limit=50&order=2");
        $recentes = $this->requestEduplay($url, null, 'GET', "?limit=50&order=3");

        $data = [
            "alta" => $vistos,
            "recentes" => $recentes,
            "curtidos" => $curtidos,
            "relevantes" => $relevantes
        ];

        return $data;
    }


    public function lives(Request $request)
    {
        $url = "https://dev.eduplay.rnp.br/services/transmission";

        $lives = $this->requestEduplay($url, null, 'GET', "");

        return $lives;
    }


    public function store(Request $request)
    {

    }

    public function show(Request $request)
    {
        $idVideo = $request['id'];

        //pegar versão

        $url = "https://dev.eduplay.rnp.br/services/video/versions/" . $idVideo;

        return $this->requestEduplay($url, null, 'GET', null);


        $url = "https://dev.eduplay.rnp.br/services/video/" . $idVideo . '/url';

        return $this->requestEduplay($url, null, 'GET', null);
    }

    public function update(Request $request)
    {


    }

    public function destroy(Request $request)
    {


    }


    private function takeVersion($id)
    {
        $url = 'https://dev.eduplay.rnp.br/services/video/versions /' . $id;

        return $this->requestEduplay($url, null, 'GET', null);
    }


    private function requestEduplay($url, $data, $type, $params = '')
    {
        $url_final = $url . $params;

        $headers = [
            'Content-Type' => 'application/json',
            'clientKey' => $this->clientKey,
            'accept' => 'application/json'
        ];

        $client = new Client([
            'headers' => $headers
        ]);

        if ($type == "GET") {
            $response = $client->get($url_final);
        }
        if ($type == "POST") {
            $response = $client->post($url_final, ['body' => json_encode($data)]);
        }

        $responseInArray = json_decode($response->getBody());

        return $responseInArray;
    }


}
