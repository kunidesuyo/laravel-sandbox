<?php

namespace App\Http\Controllers;

use App\Services\AwsService;
use Illuminate\Http\Request;

class AwsController extends Controller
{
    //

    private AwsService $awsService;
    
    function __construct(AwsService $awsService)
    {
        $this->awsService = new AwsService();
    }

    public function test() {
        // $awsService = new AwsService();
        // $listObjects = $awsService->listObjects();
        // if($listObjects == null) {
        //     return [
        //         'message' => 'test ng'
        //     ];
        // } else {
        //     return [
        //         'message' => 'test ok',
        //     ];
        // }
        return response()->json([
            'message' => 'test ok',
        ]);
    }

    public function signup(Request $request) {
        $username = $request->username;
        $password = $request->password;
        // wip
    }
}
