<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Orders\Order;

class OrdersController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = Order::query();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $data = $this->model->orderBy('id', 'desc')->get();

            return response()->json($data, 200);
        } catch (Exception $e)
        {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {

            $data = $this->model->create([
                'table' => $request->table,
                'order_cart' => json_encode($request->order_cart),
                'total_amount' => $request->total_amount,
                'payment_method' => $request->payment_method,
            ]);

            return response()->json($data, 201);
        } catch (Exception $e)
        {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $data = $this->model->findOrFail($id);

            return response()->json($data, 200);
        } catch (Exception $e)
        {
            return response()->json($e->getMessage(), 500);
        }
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
        try
        {
            $data = $this->model->findOrFail($id)->update($request->all());
            $updatedData = $this->model->find($id);

            return response()->json($updatedData, 200);
        } catch (Exception $e)
        {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $data = $this->model->findOrFail($id)->delete();

            return response()->json($data, 204);
        } catch (Exception $e)
        {
            return response()->json($e->getMessage(), 500);
        }
    }
}
