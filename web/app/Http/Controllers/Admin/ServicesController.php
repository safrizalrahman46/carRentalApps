<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use \Yajra\Datatables\Datatables;
// use App\DataTables;


use Session;
use App\Exports\ServiceExport;
use Barryvdh\DomPDF\Facade\Pdf; // Import PDF facade

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

class ServicesController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function export_tabel_Service()
    //  {
    //      return \Excel::download(new ServiceExport, 'Service.xlsx');
    //  }
    //  public function export_tabel_Service_pdf()
    //  {
    //     $Service = Service::all();
    //     $pdf = PDF::loadView('pdf.Service', compact('Service'));
    //     return $pdf->download('Service.pdf');
    //  }



    public function index(Request $request)
{
    // Get all available cars from the cars table
    // $availableCars = cars::where('is_available', 'yes')->get();

    if ($request->ajax()) {
        // $post = Service::get();
        $post = Service::get();
        return DataTables::of($post)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-success  editPost"><i class="ti-pencil"></i> EDIT</a>';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger  deletePost"><i class="ti-trash"></i> HAPUS </a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    // Pass the available cars to the view

    return view('admin.services');
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }

        $post = $request->only([
            'service_name',
            'price',
        ]);

        Service::updateOrCreate(
            ['id' => $request->id],
            $post
        );



        return response()->json(['success' => 'Service saved successfully.']);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
            'price' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $Service = Service::findOrFail($id);
        $Service->update($request->only([
            'service_name',
            'price',]));

        return response()->json(['success' => 'Service updated successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    //     $Service = Service::findOrFail($id);
    // return view('admin.Service_edit', compact('Service'));
        $post = Service::where(['id' => $id])->first();
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
        Service::where(['id' => $id])->delete();

        return response()->json(['success' => 'Category deleted successfully.']);
    }

}
