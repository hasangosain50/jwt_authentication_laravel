<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyList;

class PropertyListController extends Controller
{
    public function PropertyList(Request $req)
    {
        $propertylist = new PropertyList;
        $propertylist->property_type = $req->property_type;
        $propertylist->status = $req->status;
        $result=$propertylist->save();
        return response()->json($propertylist);
    }

    public function PropertyInfo($id){
        $propertydetails = PropertyList::find($id)->PropertyDetailsinfo;
        return response()->json($propertydetails);
        

    }
}
