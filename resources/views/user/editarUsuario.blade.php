{{-- editarUsuario.blade.php --}}

<div>
    <h5>Editar Usuario</h5>
    <form action="{{ route('asignar.update', $user) }}" method="post">
        @csrf
        @method('PUT')

        {{-- Campos para editar usuario --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ $user->name }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ $user->email }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nueva Contraseña</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
        </div>

</div>
