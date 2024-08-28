<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class StatusController extends Controller
{
    public function list(Request $request)
    {
        $status = Status::when($request->has('status'), function ($whenQuery) use ($request) {
            $whenQuery->where('status', 'like', '%' . $request->status . '%');
        })
            ->paginate(5)
            ->withQueryString();
        return view('status.list', [
            'status' => $status,
        ]);
    }

    public function create()
    {
        return view('status.create');
    }

    public function store(Request $request)
    {
        try {
            $status = Status::create($request->all());
            $status->save();
            return redirect(route('status.list'))->with('success', 'Status Cadastrado com Sucesso!');
        } catch (\Throwable $th) {
            return back()->withInput()->with('error', 'Status Já Cadastado');
        }


    }

    public function edit(Status $status)
    {
        return view('status.edit', ['status' => $status]);
    }

    public function update(Request $request, Status $status)
    {

        try {
            $status->updateOrFail([
                'status' => $request->status,
            ]);
            return redirect(route('status.list'));
        } catch (\Throwable $e) {
            dd($e);
        }



    }

    public function destroy(Status $status)
    {
        $status->destroy($status->id);
        return redirect(route('status.list'))->with('success', 'Status excluído com Sucesso!');
    }
}
