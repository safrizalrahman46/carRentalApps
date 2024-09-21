<?php

namespace App\Http\Controllers\Admin;

use App\Models\CarAvailability;
use \Yajra\Datatables\Datatables;
// use App\DataTables;
use App\Models\cars;

use Session;
use App\Exports\CarAvailabilityExport;
use Barryvdh\DomPDF\Facade\Pdf; // Import PDF facade

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

class CarAvailabilityController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function export_tabel_CarAvailability()
    //  {
    //      return \Excel::download(new CarAvailabilityExport, 'CarAvailability.xlsx');
    //  }
    //  public function export_tabel_CarAvailability_pdf()
    //  {
    //     $CarAvailability = CarAvailability::all();
    //     $pdf = PDF::loadView('pdf.CarAvailability', compact('CarAvailability'));
    //     return $pdf->download('CarAvailability.pdf');
    //  }

    // public function index(Request $request)
    // {
    //     $post = '';
    //     if ($request->ajax()) {
    //         $post = CarAvailability::get();
    //         return DataTables::of($post)
    //             ->addIndexColumn()
    //             ->addColumn('action', function ($row) {
    //                 $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-success  editPost"><i class="ti-pencil"></i> EDIT</a>';

    //                 $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger  deletePost"><i class="ti-trash"></i> HAPUS </a>';

    //                 return $btn;
    //             })
    //             // ->addColumn('status', function ($row) {
    //             //     return $row->status == 1 ? '<span class="badge badge-success">available</span>' : '<span class="badge badge-danger">Available</span>';
    //             // })
    //             ->rawColumns(['action','status'])
    //             ->make(true);
    //     }


    //     return view('admin.car_availability');
    // }

    public function index(Request $request)
{
    // Get all available cars from the cars table
    // $availableCars = cars::where('is_available', 'yes')->get();

    if ($request->ajax()) {
        // $post = CarAvailability::get();
        $post = CarAvailability::with('car')->get();
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
    $cars = cars::all();
    return view('admin.car_availability', compact('cars'));
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
            'car_id' => 'required|integer|exists:cars,id',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date',
            'status' => 'required|in:available,booked',
            'buffer_time'=> 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }

        $post = $request->only([
        'car_id', 'start_datetime', 'end_datetime', 'status','buffer_time',
        ]);

        CarAvailability::updateOrCreate(
            ['id' => $request->id],
            $post
        );



        return response()->json(['success' => 'CarAvailability saved successfully.']);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'car_id' => 'required|integer|exists:cars,id',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date',
            'status' => 'required|in:available,booked',
            'buffer_time'=> 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $CarAvailability = CarAvailability::findOrFail($id);
        $CarAvailability->update($request->only([
        'car_id', 'start_datetime', 'end_datetime', 'status', 'buffer_time',]));

        return response()->json(['success' => 'CarAvailability updated successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    //     $CarAvailability = CarAvailability::findOrFail($id);
    // return view('admin.CarAvailability_edit', compact('CarAvailability'));
        $post = CarAvailability::where(['id' => $id])->first();
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
        CarAvailability::where(['id' => $id])->delete();

        return response()->json(['success' => 'Category deleted successfully.']);
    }

}
