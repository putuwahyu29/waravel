<x-app-layout title="{{ $title }}">

    @section('content')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Device</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('devices.update',$device->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="sessionId" class="col-sm-2 col-form-label">Nama Pengguna</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sessionId" name="sessionId" value="{{$device->sessionId}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama Akun</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name',$device->name)}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="numberPhone" class="col-sm-2 col-form-label">Nomor WhatsApp</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="numberPhone" name="numberPhone" value="{{old('numberPhone',$device->numberPhone)}}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui</button>

                </form>
            </div>
        </div>

    @endsection
</x-app-layout>
