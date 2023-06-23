@if(isset($result))
<div class="row">
    <div class="col-8 offset-2">
    <img src="{{ $result->image }}" alt="Imagen de la carta" width="50">
    </div>
</div>
<div class="row">
    <div class="col-8 offset-2">
        <h1>CARTA CREADA CORRECTAMENTE</h1>
    <h2>Nombre: {{ $result->name }}</h2>
    </div>
</div>
<div class="row">
    <div class="col-8 offset-2">
    <h3> ATK:{{ $result->atk }} DEF:{{ $result->def }}</h3>
    </div>
</div>
@endif