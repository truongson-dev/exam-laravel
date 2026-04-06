<h1>Car {{ $car->id }}</h1>

<ul>
    <li>Make: {{ $car->make }}</li>
    <li>Model: {{ $car->model }}</li>
    <li>Produced on: {{ $car->produced_on }}</li>
    <li>Hình ảnh: <br>
        @if($car->image)
            <img src="{{ asset('images/' . $car->image) }}" alt="Hình ảnh {{ $car->make }}" style="max-width: 300px; max-height: 200px;">
        @else
            Không có hình ảnh
        @endif
    </li>
</ul>