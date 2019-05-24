@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Edit OSPF Network</h4>
                    <h6 class="card-subtitle mb-2 text-muted">
                        Silakan isi data OSPF Network sesuai kebutuhan Anda.
                    </h6>
                    @if (session('fail'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {!! session('fail') !!}
                        </div>
                    @endif
                    <br>
                    <form method="POST" action="{{ route('ospf.update', request()->route('ospf')) }}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group row">
                            <label for="ospf-network"
                                   class="col-md-3 col-form-label">{{ __('Network') }} <span
                                        class="text-danger">*</span></label>

                            <div class="col-md-9">
                                <input id="ospf-network" type="text" placeholder="Contoh: 192.168.1.0/24"
                                       class="form-control{{ $errors->has('ospf-network') ? ' is-invalid' : '' }}"
                                       name="ospf-network"
                                       value="{{ old('ospf-network')? old('ospf-network'): $ospf['network'] }}" required
                                       autofocus>

                                @if ($errors->has('ospf-network'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ospf-network') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ospf-area"
                                   class="col-md-3 col-form-label">{{ __('Area') }} <span
                                        class="text-danger">*</span></label>

                            <div class="col-md-9">
                                <select id="ospf-area"
                                        class="form-control{{ $errors->has('ospf-area') ? ' is-invalid' : '' }}"
                                        name="ospf-area" required autofocus>
                                    <option value="">--- Pilih area ---</option>
                                    @foreach($areas as $area)
                                        <option {{ $area['name'] == (old('ospf-area')? old('ospf-area'): $ospf['area'])?'selected':'' }} value="{{ $area['name'] }}">{{ $area['name'] }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('ospf-area'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ospf-area') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Simpan') }}
                                </button>
                                <input type="reset" value="Kosongkan" class="btn btn-warning">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
