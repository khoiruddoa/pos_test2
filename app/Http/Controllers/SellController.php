<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\Category;



use Illuminate\Http\Request;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'dashboard.sells.index'
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::find($request->category_id);

        $stock = $category->buy->sum('weight') - $category->sell->sum('weight');
        if ($request->weight >  $stock) {
            return redirect()->back()->with('failed', 'stock tidak cukup');
        }
        $request->merge([
            'price' => str_replace('.', '', $request->price)
        ]);


        $validatedData = $request->validate([
            'order_id' => 'required',
            'category_id' => 'required',
            'weight' => 'required',
            'price' => 'required'
        ]);
        $validatedData['total'] = $request['weight'] * $request['price'];

        // if ($request->weight >  $categories->weight) {
        //     return redirect('/dashboard/sells/orders')->with('failed', 'stock tidak cukup');
        // }
        Sell::create($validatedData);
        return redirect()->back()->with('success', 'Barang baru telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sell $sell)
    {

        Sell::destroy($sell->id);
        return redirect()->back()->with('success', 'Barang telah dihapus');
    }
}
