<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyDetails;


class PropertyDetailsController extends Controller
{
    public function PropertyDetails(Request $req)
    {
        $propertydetails = new PropertyDetails;
        $propertydetails->property_details_id = $req->property_details_id;
        $propertydetails->property_list_id = $req->property_list_id;
        $propertydetails->name = $req->name;
        $propertydetails->location =$req->location;
        $propertydetails->area =$req->area;
        if ($req->hasfile('photo')) {
            $file = $req->file('photo');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/photo/', $filename);
            $propertydetails->image = $filename;
        } else {
            return $req;
            $pages->image = '';
        }
        $propertydetails->room = $req->room;
        $propertydetails->price = $req->price;
        $result=$propertydetails->save();
        return response()->json($propertydetails);
       }
    }