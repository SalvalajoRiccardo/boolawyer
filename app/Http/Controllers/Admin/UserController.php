<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\User;
use App\Specialization;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user=Auth::user();
        return view('admin.users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        // $id = Auth::id();
        $specs = Specialization::all();
        $user = User::find($id);
        return view('admin.users.edit', compact('user','specs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // !!!! accanto a Request abbiamo aggiunto User $user !!!!!!
        ;
        // Validazione dati
        $request->validate([
            'name' => 'required|max:100',
            'surname' => 'required|max:100',
            'address' => 'required|max:100',
            'specializations' => 'required',
            'email' => 'required|email|max:100',
            // 'password' => 'required|min:8|confirmed',
            'photo' => 'nullable|image',
            'cv' => 'nullable|image',
            'phone' => 'nullable|min:10',
            'services' => 'nullable'
        ]);
        
        $data = $request->all();

        if ($data['surname'] != $user->surname || $data['name'] != $user->name ) {

            // Calcolo lo slug
            $slug = Str::slug($data['name'].' '.$data['surname'], '-');

            // salvo lo slug in una variabile temporanea
            $slug_base = $slug;

            // verifico se lo slug è gia presente
            $slug_ismatching= User::where('slug', $slug)->first();
            
            // dichiaro una variabile contatore
            $counter=1;

            // fintanto che lo slug è già presente($slug_ismatching == true)...//
            while ($slug_ismatching) {

                // aggiungo allo slug di un trattino e il contatore
                $slug = $slug_base.'-'.$counter;

                // verifico nuovamente se lo slug è gia presente
                $slug_ismatching= User::where('slug', $slug)->first();

                // Incremento il contatore
                $counter++;
            }

            //in ogni caso assegniamo allo slug il valore ottenuto
            $data['slug'] =$slug;
        }

        if(array_key_exists('photo',$data)){
            //salviamo la nostra immagine e recuperiamo il path
            $photo_path = Storage::put('photo', $data['photo']);

            Storage::delete($user->photo);

            //salviamo nella colonna della tabella posts l'immagine con il suo percorso
            $data['photo'] = $photo_path;
        }

        if(array_key_exists('cv',$data)){
            //salviamo la nostra immagine e recuperiamo il path
            $cv_path = Storage::put('cv', $data['cv']);

            Storage::delete($user->cv);

            //salviamo nella colonna della tabella posts l'immagine con il suo percorso
            $data['cv'] = $cv_path;
        }

        $user->update($data);

        // salvo i dati nella tabella ponte
        // if (array_key_exists('specializations', $data)) {
        //     $user->specializations()->sync($data['specializations']);
        // }
        if(isset($data['specializations'])){
            $user->specializations()->sync($data['specializations']);
        }

        return redirect()->route('admin.users.index');
        // ->with('edit','Post n. ' . $post->id . ' has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
