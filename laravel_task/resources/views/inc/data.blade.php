<ul class="list-group">
    @foreach($data as $el)
        <li class="list-group-item">{{ $el->name }} {{ $el->email }} {{ $el->phone }} @if($el->wantsToBuy)Да@endif</li>
    @endforeach
</ul>
