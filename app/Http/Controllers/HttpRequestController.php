<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HttpRequest;
use Illuminate\Support\Facades\Http;

class HttpRequestController extends Controller
{
    public function index()
    {
        $requests = HttpRequest::latest()->get();
        return view('http-requests.index', compact('requests'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|min:1',
        ]);

        $id = $request->id;
        $url = "http://127.0.0.1:8000/api/orders/{$id}";

        try {
            $response = Http::get($url);

            HttpRequest::create([
                'url' => $url,
                'status_code' => $response->status(),
                'response_body' => $response->body(),
            ]);

            return redirect()->route('http-requests.index')
                ->with('success', "Successfully fetched data for ID: {$id}");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to fetch data: ' . $e->getMessage());
        }
    }

    public function getClientCount(Request $request){

         $url = "http://127.0.0.1:8000/api/clients/count";

        $response = Http::get($url);

        HttpRequest::create([
            'url' => $url,
            'status_code' => $response->status(),
            'response_body' => $response->body()
        ]);

        return redirect()->route('http-requests.index')
            ->with('success', "Successfully fetched client count.");
    }

    public function getStatus(Request $request){
        
        $request->validate([
            'id' => 'required|integer|min:1',
        ]);

        $id = $request->id;
        $url = "http://127.0.0.1:8000/api/orders/{$id}/status";

        $response = Http::get($url);

        HttpRequest::create([
            'url'=> $url,
            'status_code' => $response->status(),
            'response_body' => $response->body()
        ]);

         return redirect()->route('http-requests.index')
            ->with('success', "Hola, aqui obtuvimos el status.");
    }
    
}
