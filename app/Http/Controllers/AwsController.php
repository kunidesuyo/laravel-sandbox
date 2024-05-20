<?php

namespace App\Http\Controllers;

use App\Services\AwsService;
use Illuminate\Http\Request;

class AwsController extends Controller
{
    //
    public function test() {
        $awsService = new AwsService();
        $listObjects = $awsService->listObjects();
        var_dump($listObjects);
        return [
            'message' => 'test ok',
            'config' => config('app.name'),
        ];
    }
}
