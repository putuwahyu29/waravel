<x-app-layout title="{{ $title }}">

    @section('content')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Template</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('templates.create') }}" class="btn btn-primary">Tambah Template</a>
                <br><br>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Pesan Diterima</th>
                            <th>Pesan Balasan</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($templates as $template)
                            <tr>
                                <td>{{ $template->title }}</td>
                                <td>{{ $template->received}}</td>
                                <td>{{ $template->reply }}</td>
{{--                                <td>--}}
{{--                                    <a href="{{ route('templates.show', $template->id) }}" class="btn btn-success">Lihat</a>--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @endsection
</x-app-layout>

