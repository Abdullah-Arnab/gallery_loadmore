@if(Auth::user()->user_type == 0)
@include('layouts.app')
@else
@include('layouts.admin')
@endif