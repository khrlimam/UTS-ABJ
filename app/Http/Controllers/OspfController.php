<?php

namespace App\Http\Controllers;

use App\Http\Mikrotik\Util\Operation;
use App\Http\Requests\OspfRequest;
use Illuminate\Support\Facades\Auth;

class OspfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ospfNetworks = Auth::user()->mikrotik()->run("routing ospf network print");
        return view('auth.ospf.index', compact('ospfNetworks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Auth::user()->mikrotik()->run("routing ospf area print");
        return view('auth.ospf.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(OspfRequest $request)
    {
        $validated = $request->validated();
        $operation = Auth::user()->mikrotik()->run("routing ospf network add", [
            'network' => $validated['ospf-network'],
            'area' => $validated['ospf-area']
        ]);
        if (Operation::isSuccess($operation))
            return redirect()->route('ospf.index')->with('status', 'Berhasil menambahkan Routing OSPF baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $areas = Auth::user()->mikrotik()->run("routing ospf area print");
        $ospf =  Auth::user()->mikrotik()->run("routing ospf area print", ["?.id" => $id]);
        return view('auth.ospf.edit', compact('areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(OspfRequest $request, $id)
    {
        $validated = $request->validated();
        $operation = Auth::user()->mikrotik()->run("routing ospf network set", [
            '.id' => $id,
            'network' => $validated['ospf-network'],
            'area' => $validated['ospf-area']
        ]);

        return redirect()->route('ospf.index')->with('status', 'Berhasil mengubah Routing OSPF baru!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $operation = Auth::user()->mikrotik()->run("routing ospf network remove", ['.id' => $id]);
        return redirect()->route('ospf.index')->with('status', 'Berhasil menghapus Routing OSPF dengan ID ' . $id . '!');
    }
}
