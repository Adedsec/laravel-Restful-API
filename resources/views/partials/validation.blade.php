@if ($errors->any())
    <div class="alert small alert-danger text-right">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
