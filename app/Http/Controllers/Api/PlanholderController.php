<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Planholder;
use Illuminate\Http\Request;

class PlanholderController extends Controller
{
   public function addPlanholder(Request $request)
   {
        // validate
        $request->validate([
            "pf_no" => "required",
            "agent_id"=>"required",
            "name" => "required|unique:planholders",
            "barangay" => "required",
            "municipality" => "required",
            "province" => "required",
            "dob"=> "required",
            "civil_status"=>"required",
            "gender" => "required",
            "region"=>"required"
        ]);

        // create user data + save
        $planholder = new Planholder();
        $planholder->agent_id = $request->agent_id;
        $planholder->pf_no = $request->pf_no;
        $planholder->name = $request->name;
        $planholder->lot_block = $request->lot_block;
        $planholder->street = $request->street;
        $planholder->barangay = $request->barangay;
        $planholder->municipality = $request->municipality;
        $planholder->province = $request->province;
        $planholder->dob = $request->dob;
        $planholder->religion = $request->religion;
        $planholder->contact = $request->contact;
        $planholder->civil_status = $request->civil_status;
        $planholder->gender = $request->gender;
        $planholder->region = $request->region;

        $planholder->save();

        // send response
        return response()->json([
            "status" => 1,
            "message"=> "Planholder registered successfully",
            "planholder" => $planholder->id
        ], 200);
   }

   public function getPlanholder()
   {
    $planholders = Planholder::get();

    return response()->json([
        "status" => 1,
        "message" => "Listing Planholders",
        "data"=> $planholders
    ], 200);
   }

   public function getSinglePlanholder($id)
   {
        if(Planholder::where("id", $id)->exists())
        {
            $planholder_detail = Planholder::where("id", $id)->first();
            return response()->json([
                "status" => 1,
                "message" => "Planholder Found",
                "data" => $planholder_detail
            ], 200);
        }
        else
        {
            return response()->json([
                "status" => 0,
                "message" => "Planholder not found"
            ], 404);
        }
   }

   public function updatePlanholder(Request $request, $id)
   {
        if(Planholder::where("id", $id)->exists())
        {
            $planholder = Planholder::find($id);
            $planholder->pf_no = !empty($request->pf_no) ? $request->pf_no: $planholder->pf_no;
            $planholder->name = !empty($request->name) ? $request->name: $planholder->name;
            $planholder->agent_id = !empty($request->agent_id) ? $request->agent_id: $planholder->agent_id;
            $planholder->lot_block = !empty($request->lot_block) ? $request->lot_block: $planholder->lot_block;
            $planholder->street = !empty($request->street) ? $request->street: $planholder->street;
            $planholder->barangay = !empty($request->barangay) ? $request->barangay: $planholder->barangay;
            $planholder->municipality = !empty($request->municipality) ? $request->municipality: $planholder->municipality;
            $planholder->province = !empty($request->province) ? $request->province: $planholder->province;
            $planholder->dob = !empty($request->dob) ? $request->dob: $planholder->dob;
            $planholder->religion = !empty($request->religion) ? $request->religion: $planholder->religion;
            $planholder->contact = !empty($request->contact) ? $request->contact: $planholder->contact;
            $planholder->civil_status = !empty($request->civil_status) ? $request->civil_status: $planholder->civil_status;
            $planholder->gender = !empty($request->gender) ? $request->gender: $planholder->gender;
            $planholder->region = !empty($request->region) ? $request->region: $planholder->region;

            $planholder->save();

            return response()->json([
                "status" => 1,
                "message" => "Planholder updated successfully"
            ], 200);
        }
        else
        {
            return response()->json([
                "status" => 0,
                "message" => "Planholder not found"
            ], 404);
        }
   }

   public function deletePlanholder($id)
   {
        if(Planholder::where("id", $id)->exists())
        {
            $planholder = Planholder::find($id);
            $planholder->delete();

            return response()->json([
                "status" => 1,
                "message"=> "Planholder successfully deleted"
            ]);
        }
        else
        {
            return response()->json([
                "status" => 0,
                "message" => "Planholder not found"
            ], 404);
        }
   }
}
