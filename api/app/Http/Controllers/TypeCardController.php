<?php

namespace App\Http\Controllers;
use App\Models\TypeCard as Model;
use App\Models\SubTypeCard;

use Illuminate\Http\Request;

class TypeCardController extends Controller
{
    public function index()
    {
        $subtypes=SubTypeCard::all();

        $types=Model::all();
        return response()->json(['types'=>$types,'subtypes'=>$subtypes],200);
  
    }
}
