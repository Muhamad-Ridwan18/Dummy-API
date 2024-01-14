<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function fetchEmployee()
    {
        $url = 'https://dummy.restapiexample.com/api/v1/employees';
        // $client = new \GuzzleHttp\Client();

        $response = Http::get($url);

        if ($response->failed()) {
            return response()->json(['error' => 'Error occurred while fetching data'], 500);
        }

        $data = $response->json();
        Log::info('JSON Response: ' . json_encode($data));

        $posts = $data;
        // dd($posts);
        return view('employees/index', compact('posts'));

    }

    public function show($id) 
    {
        $url = 'https://dummy.restapiexample.com/api/v1/employee/' . $id;

        $response = Http::get($url);

        if ($response->failed()) {
            return response()->json(['error' => 'Error occurred while fetching data'], 500);
        }

        $data = $response->json();
        Log::info('JSON Response: ' . json_encode($data));

        $post = $data['data'];
        // dd($post);
        return view('employees/show', compact('post'));
    } 

    public function store(Request $request)
    {
        $apiEndpoint = 'https://dummy.restapiexample.com/api/v1/create';

        $data = $request->all();
        $response = Http::post($apiEndpoint, $data);

        if ($response->successful()) {
            $responseData = $response->json();
            return response()->json($responseData);
        } else {
            return response()->json(['error' => 'Failed to create employee'], $response->status());
        }
    }

    public function edit($id)
    {
        $apiEndpoint = 'https://dummy.restapiexample.com/api/v1/employee/' . $id;

        $response = Http::get($apiEndpoint);

        if ($response->failed()) {
            return response()->json(['error' => 'Error occurred while fetching data'], 500);
        }

        $data = $response->json();
        Log::info('JSON Response: ' . json_encode($data));

        $employee = $data['data'];
        return view('employees/edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $apiEndpoint = 'https://dummy.restapiexample.com/api/v1/update/' . $id;

        $data = $request->all();
        $response = Http::put($apiEndpoint, $data);

        if ($response->successful()) {
            $responseData = $response->json();
            return response()->json($responseData);
        } else {
            return response()->json(['error' => 'Failed to update employee'], $response->status());
        }
    }

    public function destroy($id)
    {
        $apiEndpoint = 'https://dummy.restapiexample.com/api/v1/delete/' . $id;

        $response = Http::delete($apiEndpoint);

        if ($response->successful()) {
            $responseData = $response->json();
            return response()->json($responseData);
        } else {
            return response()->json(['error' => 'Failed to delete employee'], $response->status());
        }
    }


}
