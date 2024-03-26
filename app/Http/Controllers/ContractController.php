<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContractFormRequest;
use App\Models\Contract;
use App\Models\Staff;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Contract::class, 'contract');
    }

    public function index()
    {
        $contracts = Contract::orderBy('created_at', 'desc')->paginate(10);
        return view('rh.contracts.index', compact('contracts'));
    }

    public function create()
    {
        return view('rh.contracts.form',
            [
                'contract' => new Contract(),
                'staffs' => Staff::all(),
                'contractTypes' => ['CDI', 'CDD', 'CTT', 'Stage', 'Alternance'],
                'status' => ['En cours', 'Terminé', 'Résilié'],
            ]
        );
    }

    public function store(ContractFormRequest $request)
    {
        $data = $request->validated();
        $contract = Contract::create($data);
        return redirect()->route('rh.contracts.index')->with('success', 'Contrat créé avec succès');
    }

    public function show(Contract $contract)
    {
        return view('rh.contracts.show', compact('contract'));
    }

    public function edit(Contract $contract)
    {
        return view('rh.contracts.form',
            [
                'contract' => $contract,
                'staffs' => Staff::all(),
                'contractTypes' => ['CDI', 'CDD', 'CTT', 'Stage', 'Alternance'],
                'status' => ['En cours', 'Terminé', 'Résilié'],
            ]
        );
    }

    public function update(ContractFormRequest $request, Contract $contract)
    {
        $data = $request->validated();
        $contract->update($data);
        return redirect()->route('rh.contracts.index')->with('success', 'Contrat modifié avec succès');
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();
        return redirect()->route('rh.contracts.index')->with('success', 'Contrat supprimé avec succès');
    }
}
