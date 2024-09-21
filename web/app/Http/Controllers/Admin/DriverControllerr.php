<?php

namespace App\Http\Controllers\Admin;

// use DataTables;
use App\Models\Driver;
use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Models\AdditionalService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \Yajra\Datatables\Datatables;

class DriverControllerr extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $post = '';
        if ($request->ajax()) {
            $post = Driver::get();
            return DataTables::of($post)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-success  editPost"><i class="ti-pencil"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger  deletePost"><i class="ti-trash"></i></a>';
                })

                ->rawColumns(['action'])
                ->make(true);
        }


        return view('tour_package');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $id = $request->id;
        $password = $request->password;

        $validator = [];


        $validator = Validator::make($request->all(), [

            'banner_url' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'description' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }


        $post = [
            'zone_name' => $request->zone_name,
            'rate' => $request->rate,
        ];


        Driver::updateOrCreate(
            ['id' => $id],
            $post
        );


        return response()->json(['success' => 'Promotion saved successfully.']);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Driver::find($id);
        return response()->json($post);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Driver::find($id)->delete();

        return response()->json(['success' => 'Promotion deleted successfully.']);
    }
}
