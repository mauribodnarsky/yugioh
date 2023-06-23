<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<div class="container">
    
<div class="row">
        <div class="col-12">
        @if(isset($registroborrado) && ($registroborrado===true))
        <H2>CARTA BORRADA CORRECTAMENTE</H2>
        @endif
        @if(isset($registroborrado) && ($registroborrado===false))

<h2>ERROR AL BORRAR</h2>
        @endif
        @if(isset($registroupdate) && ($registroupdate===true))
        <H2>CARTA BORRADA CORRECTAMENTE</H2>
        @endif
        @if(isset($registroupdate) && ($registroupdate===false))

<h2>ERROR AL BORRAR</h2>
        @endif
        </div>
        </div>
    <div class="row">
        <div class="col-12">
            <h6 class="text-bold mt-3">Listado de cartas</h6></div>
        <div class="col-3">
            <button class="btn btn-success my-1" data-bs-toggle="modal" data-bs-target="#newcardmodal" >CREAR CARTA</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
                         <!-- Modal crear carta -->

    <div class="modal" tabindex="-1" id="newcardmodal" role="dialog" >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Nueva Carta</h5>
            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close" >
            </button>
          </div>

          <div class="modal-body">
            <form action="{{ route('crear_carta') }}" method="POST" enctype="multipart/form-data">    @csrf

              <div class="form-group">
                <label for="code">Código</label>
                <input type="text" class="form-control" id="code" name="code" >
              </div>
              <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" >
              </div>
              <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" id="description" name="description" ></textarea>
              </div>
              <div class="form-group">
                  <label for="id_type_card">Tipo</label>
                  <select  name="id_type_card"  class="form-select" >
                  @Foreach($types_cards as $type)

                      <option    value="{{$type->id}}">{{$type->name}}</option>
                  @endforeach
                  </select>

              </div>
              
              <div class="form-group">
                  <label for="id_subtype_card">Sub Tipo</label>
                  <select  name="id_subtype_card"  class="form-select" >

                  @Foreach($subtypes_cards as $subtype)
                      <option    value="{{$subtype->id}}">{{$subtype->name}}</option>
                  @endforeach
                  </select>

              </div>
              <div class="form-group">
                <label for="image">Imagen</label> 
                <input type="file" name="image"  />
              </div>
              <div class="form-group">
                <label for="price">Precio</label>
                <input type="text" class="form-control" id="price" name="price" >
              </div>
              <div class="form-group">
                  <label for="atk">Ataque</label>
                  <input type="text" class="form-control" id="atk" name="atk" >
                </div>
                <div class="form-group">
                  <label for="def">Defensa</label>
                  <input type="text" class="form-control" id="def" name="def">
                </div>
              <div class="form-group">
                <label for="stars">Estrellas</label>
                <input type="text" class="form-control" id="stars" name="stars" >
              </div>
              <input type="submit" class="btn btn-primary" value="Guardar">

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
                          <!-- fin Modal crear carta -->
        </div>
    </div>
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>NOMBRE</th>
              <th>TIPO</th>
              <th>IMAGEN</th>
              <th>ATK</th>
              <th>DEF</th>
              <th>ACCIONES</th>
        
            </tr>
          </thead>
          <tbody>
            @foreach ($result as $card)
            <tr>
            <td>{{ $card->name }}</td>
            <td>{{ $card->type_card->name }} | {{ $card->sub_type_card->name }}</td>
            <td><img src="{{ $card->image }}" alt="Imagen de la carta" width="50"></td>
            <td>{{ $card->atk }}</td>
            <td>{{ $card->def }}</td>
            <td>         
                   <button class="btn btn-primary my-1 d-inline-block mr-2" data-bs-toggle="modal"  onclick="editcard('{{json_encode($card)}}')"  data-bs-target="#editcardmodal" >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>
            </button>
            <button class="btn btn-danger my-1 d-inline-block mr-2" data-bs-toggle="modal" onclick="deletecard('{{$card->id}}','{{$card->name}}')" data-bs-target="#deletecardmodal" >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
</svg>
            </button>

        </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal editar carta -->
<div class="modal" tabindex="-1" id="editcardmodal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Carta</h5>
        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="{{ route('editar_carta') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" id="edit_card_id" name="id">

          <div class="form-group">
            <label for="edit_code">Código</label>
            <input type="text" class="form-control" id="edit_code" name="code">
          </div>
          <div class="form-group">
            <label for="edit_name">Nombre</label>
            <input type="text" class="form-control" id="edit_name" name="name">
          </div>
          <div class="form-group">
            <label for="edit_description">Descripción</label>
            <textarea class="form-control" id="edit_description" name="description"></textarea>
          </div>
          <div class="form-group">
            <label for="edit_id_type_card">Tipo</label>
            <select name="id_type_card" class="form-select" id="edit_id_type_card">
              @foreach($types_cards as $type)
              <option value="{{$type->id}}">{{$type->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="edit_id_subtype_card">Sub Tipo</label>
            <select name="id_subtype_card" class="form-select" id="edit_id_subtype_card">
              @foreach($subtypes_cards as $subtype)
              <option value="{{$subtype->id}}">{{$subtype->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="edit_image">Imagen</label>
            <input type="file" name="image" id="edit_image">
          </div>
          <div class="form-group">
            <label for="edit_price">Precio</label>
            <input type="text" class="form-control" id="edit_price" name="price">
          </div>
          <div class="form-group">
            <label for="edit_atk">Ataque</label>
            <input type="text" class="form-control" id="edit_atk" name="atk">
          </div>
          <div class="form-group">
            <label for="edit_def">Defensa</label>
            <input type="text" class="form-control" id="edit_def" name="def">
          </div>
          <div class="form-group">
            <label for="edit_stars">Estrellas</label>
            <input type="text" class="form-control" id="edit_stars" name="stars">
          </div>
          <input type="submit" class="btn btn-primary" value="Guardar">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal editar carta -->
                      <!-- Modal borrar carta -->

                      <div class="modal" tabindex="-1" id="deletecardmodal" role="dialog" >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Borrar Carta</h5>
            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close" >
            </button>
          </div>

          <div class="modal-body">
            <form action="{{ route('borrar_carta') }}" method="POST">    @csrf

              <div class="form-group">
                <label  id="name_deleted"></label>
                <input type="hidden" class="form-control" id="id_deleted" name="id_deleted" >
              </div>
       
         
              <input type="submit" class="btn btn-danger" value="Si, borrar">

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Cancelar</button>
          </div>
        </div>
      </div>
    </div>
                          <!-- fin Modal borrar carta -->






<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
    function deletecard(id,name){
        document.getElementById("id_deleted").value=id
        document.getElementById("name_deleted").innerHTML="¿Deseas borrar "+name+"?"

    }
    function editcard(card) {
        console.log(JSON.parse(card))
        card=JSON.parse(card)
    // Establecer los valores en los campos de la modal de edición
    document.getElementById('edit_card_id').value = card.id;
    document.getElementById('edit_code').value = card.code;
    document.getElementById('edit_name').value = card.name;
    document.getElementById('edit_description').value = card.description;
    document.getElementById('edit_id_type_card').value = card.id_type_card;
    document.getElementById('edit_id_subtype_card').value = card.id_subtype_card;
    document.getElementById('edit_price').value = card.price;
    document.getElementById('edit_atk').value = card.atk;
    document.getElementById('edit_def').value = card.def;
    document.getElementById('edit_stars').value = card.stars;
    // ...
    // Resto de los campos que debes establecer
  }
</script>