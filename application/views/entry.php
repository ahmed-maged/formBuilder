@layout('templates.main')
@section('content')
<div class="form_area" style="min-height: 300px;">
    <h3 style="text-align: center">Entry {{ $entry[0]->form_number }}</h3>
    <ul class="forms_list">
@foreach( $entry as $input )
<li>
    {{ $input->input->name }} : {{ $input->data }}
</li>
@endforeach
    </ul>
</div>
@endsection