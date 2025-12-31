<?php

namespace App\Http\Controllers;

use App\Models\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ReclamationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $user_id = auth()->user()->id;
    $reclamations = Reclamation::where('user_id', $user_id)->get();
    return response()->view('page2', compact('reclamations'));


}
public function indexe()
{return view('formulaire');}

public function indexsocial()
{return view('formulairesocial');}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function faireReclamation() {
        // Logique pour faire une réclamation
    }

    public function faireDemandeBourse() {
        // Logique pour faire une demande de bourse
    }

    public function create()
    {
          $uid = uniqid();
          $user_id = Auth::user()->id;
         return view('reclamations', compact('uid', 'user_id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reclamation = new Reclamation;
        $reclamation->uid = Str::uuid();
        $reclamation->objet = $request->input('objet');
        $reclamation->message = $request->input('message');
        $reclamation->user_id = auth()->user()->id;
        $reclamation->save();

        $message = 'La réclamation a été créée avec succès!';

    return response()->redirectTo(route('page2'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reclamation  $reclamation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    $reclamation = Reclamation::findOrFail($id);
    return view('reclamations.show', compact('reclamation'));
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reclamation  $reclamation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reclamation $reclamation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reclamation  $reclamation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reclamation $reclamation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reclamation  $reclamation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reclamation $reclamation)
    {
        //
    }
}
