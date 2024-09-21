<?php

namespace App\Http\Controllers\Admin;

use App\Models\TourPackage;
use \Yajra\Datatables\Datatables;
// use App\DataTables;


use Session;
use App\Exports\TourPackageExport;
use Barryvdh\DomPDF\Facade\Pdf; // Import PDF facade

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

class TourPackagesController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function export_tabel_TourPackage()
    //  {
    //      return \Excel::download(new TourPackageExport, 'TourPackage.xlsx');
    //  }
    //  public function export_tabel_TourPackage_pdf()
    //  {
    //     $TourPackage = TourPackage::all();
    //     $pdf = PDF::loadView('pdf.TourPackage', compact('TourPackage'));
    //     return $pdf->download('TourPackage.pdf');
    //  }



    public function index(Request $request)
{
    // Get all available cars from the cars table
    // $availableCars = cars::where('is_available', 'yes')->get();

    if ($request->ajax()) {
        // $post = TourPackage::get();
        $post = TourPackage::get();
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

    return view('admin.tour_packages');
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
            'package_name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'duration' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }

        $post = $request->only([
            'package_name',
            'description',
            'price',
            'duration',

        ]);

        TourPackage::updateOrCreate(
            ['id' => $request->id],
            $post
        );



        return response()->json(['success' => 'TourPackage saved successfully.']);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'package_name' => 'required',
            'description'  => 'required',
            'price'  => 'required',
            'duration' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $TourPackage = TourPackage::findOrFail($id);
        $TourPackage->update($request->only([
            'package_name',
            'description',
            'price',
            'duration',

        ]));

        return response()->json(['success' => 'TourPackage updated successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    //     $TourPackage = TourPackage::findOrFail($id);
    // return view('admin.TourPackage_edit', compact('TourPackage'));
        $post = TourPackage::where(['id' => $id])->first();
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
        TourPackage::where(['id' => $id])->delete();

        return response()->json(['success' => 'Category deleted successfully.']);
    }

}
