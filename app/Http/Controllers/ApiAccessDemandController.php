<?php

namespace App\Http\Controllers;

use App\Models\ApiAccessDemand;
use App\Http\Requests\ApiAccessDemandRequest;
use App\Mail\ApiAccessDemandMail;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class ApiAccessDemandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lancer les files d'attentes
        // Artisan::call('queue:word');
        $apiAccessDemands = ApiAccessDemand::latest('id')->paginate(12);
        return view('demand.index', compact('apiAccessDemands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('demand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApiAccessDemandRequest $request)
    {
        try {
            $data = $request->validated();
            ApiAccessDemand::create($data);
            // Mettre l'envoi du mail dans le file d'attente pour eviter que l'enregistrement prenne trop temps.

            // Mail::to($data['email'])->queue(new ApiAccessDemandMail($data));
            Mail::to($data['email'])->send(new ApiAccessDemandMail($data));
            return redirect()->route('api-access-demands.index')->with('success', 'Demande enregistrée avec succès');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ApiAccessDemand $apiAccessDemand)
    {
        return view('demand.show', [
            'apiAccessDemand' => $apiAccessDemand,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApiAccessDemand $apiAccessDemand)
    {
        return view('demand.edit', compact('apiAccessDemand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApiAccessDemandRequest $request, ApiAccessDemand $apiAccessDemand)
    {
        // dd($request->validated());
        $apiAccessDemand->update($request->validated());
        return to_route('api-access-demands.index')->with('Modification éffectuée', 'info');
        return to_route('api-access-demands.index')->with('success', 'Modification éffectuée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApiAccessDemand $apiAccessDemand)
    {
        $apiAccessDemand->delete();
        return to_route('api-access-demands.index')->with('success', 'Suppression effectuée avec succès');
    }
}
