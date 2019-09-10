@extends('layout')
@section('content')
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message}}</p>
    </div>
@endif

<div class="row">
    <div class="col-md-6">
        <h1>All Loans</h1>
        <a href="{{ action('PostController@create') }}" class="btn btn-primary">Add New Loan</a>
    </div>
</div>
<form method="post">
  @csrf
  @method('DELETE')
  <button formaction="/deleteall" type="submit" class="btn btn-danger">Delete All Selected</button>
<table class="table table-bordered">
    <thead>
        <tr>
            <th><input type="checkbox" class="selectall"></th>
            <th>ID</th>
            <th>Loan Amount</th>
            <th>Loan Term</th>
            <th>Interest Rate</th>
            <th>Created at</th>
            <th width="230">Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td><input type="checkbox" name="ids[]" class="selectbox" value="{{ $post->id }}"</td>
            <td>{{ $post->id }}</td>
            <td>{{ $post->loanAmount }} ฿</td>
            <td>{{ $post->loanTerm }} Years</td>
            <td>{{ $post->interestRate }} %</td>
            <td>{{ $post->created_at }}</td>
            <td>
              <a href="{{ action('PostController@detail', $post->id) }}" class="btn btn-info">View</a>
                    <a href="{{ action('PostController@edit', $post->id) }}" class="btn btn-warning">Edit</a>
                    <button formaction="{{ action('PostController@destroy', $post->id) }}" type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
      <tr>
          <th><input type="checkbox" class="selectall2"></th>
          <th>ID</th>
          <th>Loan Amount</th>
          <th>Loan Term</th>
          <th>Interest Rate</th>
          <th>Created at</th>
          <th width="230">Edit</th>
      </tr>
    </tfoot>
</table>
{{ $posts->links() }}

<script type="text/javascript">
    $('.selectall').click(function(){
        $('.selectbox').prop('checked', $(this).prop('checked'));
        $('.selectall2').prop('checked', $(this).prop('checked'));
    })
    $('.selectall2').click(function(){
        $('.selectbox').prop('checked', $(this).prop('checked'));
        $('.selectall').prop('checked', $(this).prop('checked'));
    })
    $('.selectbox').change(function(){
        var total = $('.selectbox').length;
        var number = $('.selectbox:checked').length;
        if(total == number){
            $('.selectall').prop('checked', true);
            $('.selectall2').prop('checked', true);
        } else{
            $('.selectall').prop('checked', false);
            $('.selectall2').prop('checked', false);
        }
    })
</script>

@endsection
