<?php

namespace App\Http\Controllers;

use App\Services\AwsService;
use Illuminate\Http\Request;

class AwsController extends Controller
{
    //
    public function test() {
        $awsService = new AwsService();
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
}
