<?php

namespace App\Http\Controllers\Admin;

use App\Models\Promotion;
use \Yajra\Datatables\Datatables;
// use App\DataTables;


use Session;
use App\Exports\PromotionExport;
use Barryvdh\DomPDF\Facade\Pdf; // Import PDF facade

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

class PromotionsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function export_tabel_Promotion()
    //  {
    //      return \Excel::download(new PromotionExport, 'Promotion.xlsx');
    //  }
    //  public function export_tabel_Promotion_pdf()
    //  {
    //     $Promotion = Promotion::all();
    //     $pdf = PDF::loadView('pdf.Promotion', compact('Promotion'));
    //     return $pdf->download('Promotion.pdf');
    //  }



    public function index(Request $request)
{
    // Get all available cars from the cars table
    // $availableCars = cars::where('is_available', 'yes')->get();

    if ($request->ajax()) {
        // $post = Promotion::get();
        $post = Promotion::get();
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

    return view('admin.Promotions');
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
            'banner_url' => 'required',
            'description' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }

        $post = $request->only([
            'banner_url',
            'description',

        ]);

        Promotion::updateOrCreate(
            ['id' => $request->id],
            $post
        );



        return response()->json(['success' => 'Promotion saved successfully.']);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'banner_url' => 'required',
            'description' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $Promotion = Promotion::findOrFail($id);
        $Promotion->update($request->only([
            'banner_url',
            'description',
        ]));

        return response()->json(['success' => 'Promotion updated successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    //     $Promotion = Promotion::findOrFail($id);
    // return view('admin.Promotion_edit', compact('Promotion'));
        $post = Promotion::where(['id' => $id])->first();
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
        Promotion::where(['id' => $id])->delete();

        return response()->json(['success' => 'Category deleted successfully.']);
    }

}
