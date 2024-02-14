
<div class="col-md-12">
    <div class="form-group">
        <label for="">Nombre del Rol:</label>
        <input type="name" name="name" id="name" class="form-control"
            value="{{ old('name') }}">
        @foreach ($errors->get('name') as $error)
            <span class="text text-danger">{{ $error }}</span>
        @endforeach
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <h4><i class="fas fa-key" style="color:#2fb98b"></i> Permisos para este Rol:</h4>
        <div class="row">
            @foreach ($permission as $index => $value)
                <div class="col-md-3">
                    <hr>
                    <label class="mr-3">
                        <input type="checkbox" name="permission[]" value="{{ $value->name }}"> {{ $value->name }}
                    </label>
                </div>
                @if (($index + 1) % 4 == 0)
                    
                @endif
            @endforeach
        </div>
    </div>
</div>


<div class="col-md-12">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
    <a type="button" class="btn btn-secondary" href="{{ route('roles.index') }}"><i class="fas fa-arrow-left"></i>
        Cancelar</a>
</div>
