<x-app-layout title="{{ $title }}">

    @section('content')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Device</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('templates.store') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="received" class="col-sm-2 col-form-label">Pesan Diterima</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="received" name="received">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reply" class="col-sm-2 col-form-label">Pesan Balasan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="reply" name="reply">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah</button>

                </form>
            </div>
        </div>

    @endsection
</x-app-layout>

