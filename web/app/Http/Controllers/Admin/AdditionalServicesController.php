<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdditionalService;
use \Yajra\Datatables\Datatables;
// use App\DataTables;


use Session;
use App\Exports\AdditionalServiceExport;
use Barryvdh\DomPDF\Facade\Pdf; // Import PDF facade

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

class AdditionalServicesController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function export_tabel_Charge()
    //  {
    //      return \Excel::download(new ChargeExport, 'Charge.xlsx');
    //  }
    //  public function export_tabel_Charge_pdf()
    //  {
    //     $Charge = Charge::all();
    //     $pdf = PDF::loadView('pdf.Charge', compact('Charge'));
    //     return $pdf->download('Charge.pdf');
    //  }



    public function index(Request $request)
{
    // Get all available cars from the cars table
    // $availableCars = cars::where('is_available', 'yes')->get();

    if ($request->ajax()) {
        // $post = Charge::get();
        $post = AdditionalService::get();
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

    return view('admin.additional_services');
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
            'name' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }

        $post = $request->only([
            'name',
            'price',
        ]);

        AdditionalService::updateOrCreate(
            ['id' => $request->id],
            $post
        );



        return response()->json(['success' => 'Charge saved successfully.']);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $AdditionalService = AdditionalService::findOrFail($id);
        $AdditionalService->update($request->only([
            'name',
            'price',
        ]));

        return response()->json(['success' => 'Charge updated successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    //     $Charge = Charge::findOrFail($id);
    // return view('admin.Charge_edit', compact('Charge'));
        $post = AdditionalService::where(['id' => $id])->first();
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
        AdditionalService::where(['id' => $id])->delete();

        return response()->json(['success' => 'Category deleted successfully.']);
    }

}
