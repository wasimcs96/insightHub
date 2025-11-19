<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\ModalService;

class ModalController extends Controller
{
    public function show($module, $key, Request $request)
    {
        $modal = app(ModalService::class)->get($module, $key, $request->all());
    
        return response()->json($modal);
    }
}