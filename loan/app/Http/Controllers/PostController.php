<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use app\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('posts')->paginate(15);
        return view('index',['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    public function search(Request $request)
    {
        //$search = $request->get('search');
        //$posts = DB::table('posts')->where('author', 'like', '%'.$search.'%')->paginate(5);
        //return view('index', ['posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'loanAmount' => 'required',
            'loanTerm' => 'required',
            'interestRate' => 'required'
        ]);
        $loanAmount = $request->get('loanAmount');
        $loanTerm = $request->get('loanTerm');
        $interestRate = $request->get('interestRate');
        $date = $request->get('date');
        $posts = DB::insert('insert into posts(loanAmount, loanTerm, interestRate) value(?,?,?)', [$loanAmount, $loanTerm, $interestRate]);
        if($posts){
            $red = redirect('posts')->with('success', 'data has been added');
        } else{
            $red = redirect('posts/create')->with('danger', 'Input data failed, please try again');
        }
        return $red;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = DB::select('select * from posts where id=?', [$id]);
        return view('show', ['posts' => $posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = DB::select('select * from posts where id=?', [$id]);
        return view('edit', ['posts' => $posts]);
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
        $request->validate([
            'loanAmount' => 'required',
            'loanTerm' => 'required',
            'interestRate' => 'required'
        ]);

        $loanAmount = $request->get('loanAmount');
        $loanTerm = $request->get('loanTerm');
        $interestRate = $request->get('interestRate');
        $posts = DB::update('update posts set loanAmount=?, loanTerm=?, interestRate=? where id=?', [$loanAmount, $loanTerm, $interestRate, $id]);
        if($posts){
            $red = redirect('posts')->with('success', 'Data has been updated');
        } else{
            $red = redirect('posts/edit/'.$id)->with('danger', 'Error update please try again');
        }
        return $red;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
         $posts = DB::delete('delete from posts where id=?',[$id]);
         $red = redirect('posts');
         return $red;
     }

     public function deleteAll(Request $request){
         $ids = $request->get('ids');
         $dbs = DB::delete('delete from posts where id in ('.implode(",",$ids).')');
         return redirect('posts');
     }
     public function detail()
     {
         $repayments = DB::table('repayments')->paginate(15);
         return view('detail',['repayments' => $repayments]);
     }

}
