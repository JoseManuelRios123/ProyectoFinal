{{-- asignarRoles.blade.php --}}

<div>
    <h5>Lista de Roles</h5>
    <form action="{{ route('asignar.asignarRoles', $user) }}" method="post">
        @csrf

        {{-- Campos para asignar roles (puedes agregar más campos según tus necesidades) --}}
        @foreach($roles as $role)
            <div>
                <label>
                    {!! Form::checkbox('roles[]', $role->id, $user->hasAnyRole($role->id) ? : false, ['class'=>'mr-1']) !!}
                    {{ $role->name }}
                </label>
            </div>
        @endforeach

        {!! Form::submit('Guardar Cambios',['class'=>'btn btn-outline-primary mt-3']) !!}
    </form>
</div>
