<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index(){
        $properties = Property::all();
        return view("admin.property.index",compact('properties'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=>['required','string','max:100'],
            'desc'=>['required','string','max:100'],
        ]);

        if ($validator->passes()) {
            $property = new Property();
            $property->name = $request->name;
            $property->desc = $request->desc;
            $property->status = $request->status;
            $property->save();

            header('Content-Type: application/json');
            echo json_encode(['success'=> true]);
            exit;
        }
        header('Content-Type: application/json');
        echo json_encode(['success'=> false]);
        exit;
    }
}
