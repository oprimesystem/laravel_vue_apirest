<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
           
            $token = '8c47ba3c6fc43500cc77b6ca5ca052e496adb3367da880875ad032d9ce6188d4';
            $client = new Client();
            $guzzleResponse = $client->get('https://gorest.co.in/public/v2/users',
            ['verify' => false,
                'headers' => [
                    'Content-Type' => 'application/json;charset=UTF-8',
                    'Access-Control-Allow-Origin' => "*", 
                    'Authorization' => 'Bearer '.$token 
                ]
            ]);
            if ($guzzleResponse->getStatusCode() == 200) {
                $response = json_decode($guzzleResponse->getBody(),true);
                return  response()->json($response);
               
            }
        }
        catch(Exception $e){
               
        }

       
       /* $client = new client([
            'base_uri'=>'https://jsonplaceholder.typicode.com',
            'timeout'=>0,
        ]);

        $response = $client->request('get','posts');
        $data = $response->getBody()->getContents();
        
        return $data;*/
        
        
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = '8c47ba3c6fc43500cc77b6ca5ca052e496adb3367da880875ad032d9ce6188d4';
        $data = ['name'=>$request->name, 
                 'email'=>$request->email,
                 'gender'=>$request->gender,
                 'status'=>$request->status];
       
        $client = new Client();
        $response = $client->post('https://gorest.co.in/public/v2/users', [ 'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Access-Control-Allow-Origin' => "*", 
                'Authorization' => 'Bearer '.$token 
            ],
            'body'=> json_encode($data),
              
        ])->getBody()->getContents();

        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $id_usuario = $id;
            $token = '8c47ba3c6fc43500cc77b6ca5ca052e496adb3367da880875ad032d9ce6188d4';
           
            
            $client = new Client();
            $guzzleResponse = $client->get("http://gorest.co.in/public/v2/users/$id_usuario",
            ['verify' => false,
                'headers' => [
                    'Content-Type' => 'application/json;charset=UTF-8',
                    'Access-Control-Allow-Origin' => "*", 
                    'Authorization' => 'Bearer '.$token 
                ]
            ]);
            if ($guzzleResponse->getStatusCode() == 200) {
                $response = json_decode($guzzleResponse->getBody(),true);
                return  response()->json($response);
               
            }
        }
        catch(Exception $e){
               
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  
     
        $token = '8c47ba3c6fc43500cc77b6ca5ca052e496adb3367da880875ad032d9ce6188d4';
        $data = ['name'=>$request->name, 
                 'email'=>$request->email,
                 'gender'=>$request->gender,
                 'status'=>$request->status];

        $client = new Client();
        $response = $client->put('https://gorest.co.in/public/v2/users/'.$id, [ 'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Access-Control-Allow-Origin' => "*", 
                'Authorization' => 'Bearer '.$token 
            ],
            'body'=> json_encode($data),
              
        ])->getBody()->getContents();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = new Client();
        $token = '8c47ba3c6fc43500cc77b6ca5ca052e496adb3367da880875ad032d9ce6188d4';
        $response = $client->delete('https://gorest.co.in/public/v2/users/'.$id, [ 'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Access-Control-Allow-Origin' => "*", 
                'Authorization' => 'Bearer '.$token 
            ]])->getBody()->getContents();
    }

    public function findUser(Request $request){
        if($request->email != null){
            
        }
         
    }
}
