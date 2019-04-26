<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
  public function sendResponse($res,$msg)
  {
     $r=[
         'success' => true,
         'data'    => $res,
         'message'    => $msg,
     ];

     return response()->json($r, 200);
  }
  public function sendError($err,$ermsg=[])
  {
     $r = [
         'success' => false,
         'message' => $err,
     ];
     if(!empty($ermsg)){
         $r['data'] = $ermsg;
     }
     return response()->json($r, 404);
  }
}
