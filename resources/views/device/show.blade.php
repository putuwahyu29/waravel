<x-app-layout title="{{ $title }}">

    @section('content')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Device</h6>
            </div>
            <div class="card-body">
                    <div class="form-group row">
                        <label for="sessionId" class="col-sm-2 col-form-label">Nama Pengguna</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sessionId" name="sessionId" value="{{$device->sessionId}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama Akun</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="{{$device->name}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="numberPhone" class="col-sm-2 col-form-label">Nomor WhatsApp</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="numberPhone" name="numberPhone" value="{{$device->numberPhone}}" disabled>
                        </div>
                    </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status Perangkat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="status" name="numberPhone" value="{{$device->status}}" disabled>
                    </div>
                </div>
            </div>
        </div>


        @if($device->status != "AUTHENTICATED")
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Scan QR Code</h6>
                </div>
                <div class="card-body">
                    <img src="{{ $image }}" alt="image">
                </div>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Aksi</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('devices.destroy', $device->id) }}" method="post" style="display: inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            {{$reloadPage}}
        </script>
    @endsection
</x-app-layout>

