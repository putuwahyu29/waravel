<x-app-layout title="{{ $title }}">

    @section('content')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Devices</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('devices.create') }}" class="btn btn-primary">Tambah Device</a>
                <br><br>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nama Pengguna</th>
                            <th>Nama Akun</th>
                            <th>Nomor WhatsApp</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($devices as $device)
                            <tr>
                                <td>{{ $device->sessionId }}</td>
                                <td>{{ $device->name }}</td>
                                <td>{{ $device->numberPhone }}</td>
                                <td>
                                    <a href="{{ route('devices.show', $device->id) }}" class="btn btn-success">Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @endsection
</x-app-layout>

