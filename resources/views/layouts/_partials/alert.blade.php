@if (Session::has('message'))
<p class="text-white alert alert-info">{{ Session::get('message') }}</p>
@endif
@if (count($errors) > 0)
<div class="text-white alert alert-danger alert-info">
    <ul class="p-0 m-0" style="list-style: none;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif