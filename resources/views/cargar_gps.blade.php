@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h3>Cargar Archivo GPS</h3>
        <form id="form-gps" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="file" name="archivo_gps" class="form-control" required>
            </div>
            <button type="button" class="btn btn-primary" id="btn-cargar-gps">
    <span id="spinner" class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"></span>
    Cargar
</button>

        </form>

        <div id="alerta-gps" class="alert alert-success mt-3 d-none" role="alert">
            ¡Archivo cargado exitosamente!
        </div>
    </div>
</div>

<script>
document.getElementById('btn-cargar-gps').addEventListener('click', function () {
    let boton = this;
    let spinner = document.getElementById('spinner');
    let form = document.getElementById('form-gps');
    let formData = new FormData(form);
    let token = document.querySelector('input[name="_token"]').value;

    // Mostrar spinner y deshabilitar botón
    spinner.classList.remove('d-none');
    boton.disabled = true;

    fetch("{{ url('/cargar') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        spinner.classList.add('d-none');
        boton.disabled = false;

        if (data.success) {
            let alerta = document.getElementById('alerta-gps');
            alerta.classList.remove('d-none');
            alerta.classList.add('show');
            form.reset();

            setTimeout(() => {
                alerta.classList.remove('show');
                alerta.classList.add('d-none');
            }, 3000);
        } else {
            alert('Error al cargar archivo');
        }
    })
    .catch(error => {
        spinner.classList.add('d-none');
        boton.disabled = false;

        alert('Ocurrió un error');
        console.error(error);
    });
});
</script>
@endsection

