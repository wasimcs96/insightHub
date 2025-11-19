@if(session()->has('success'))
{{ session('success') }}
@endif
@if(session()->has('error'))
{{ session('error') }}
@endif
<form action="{{ route('organization-chart.import-data') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <input type="file" name="file">
    <button class="btn btn-primary" tyoe="submit">Submit</button>
</form>