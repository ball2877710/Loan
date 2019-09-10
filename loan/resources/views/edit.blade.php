@extends('layout')
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
      <h1>Edit Loans</h1>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        @foreach($posts as $post)
        <form action="{{ action('PostController@update', $post->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Loan Amount:</label>
                <input type="number" name="loanAmount" value="{{ $post->loanAmount }}"/>
                <label>฿</label>
            </div>
            <div class="form-group">
                <label>Loan Term:</label>
                <input type="number" name="loanTerm" value="{{ $post->loanTerm }}"/>
                <label>Years</label>
            </div>
            <div class="form-group">
                <label>Interest Rate:</label>
                <input type="number" name="interestRate" value="{{ $post->interestRate }}"/>
                <label>%</label>
            </div>
            <div class="form-group">
              <label>Start Date:</label>
              <select name="month_select" placeholder="month_select">
                <?php
                for($i = 0; $i <= 12; ++$i){
                  $time = strtotime(sprintf('--%d months', $i));
                  $monthValue = date('m',$time);
                  $monthname = date('F',$time);
                  printf('<option value="%s">%s</option>',$monthValue,$monthname);
                }
                 ?>
              </select>
              <select name="year_select" placeholder="year_select">
                <?php $y=(int)date("Y"); ?>
                <option value="<?php echo $y; ?>" selected="true"><?php echo $y; ?></option>
                <?php $y--;
                for(; $y>"2000"; $y--){ ?>
                  <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                <?php } ?>
              </select>
            </div>
            <button class="btn btn-warning" type="submit">Update</button>
            <a href="{{ action('PostController@index') }}" class="btn btn-default">Back</a>
        </form>
        @endforeach
      </div>
  </div>
  @endsection
