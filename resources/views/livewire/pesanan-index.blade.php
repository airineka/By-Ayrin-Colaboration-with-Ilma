<div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Pesanan')}}
        </h2>

        <div class="py-12">
            <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-x1 sm:rounded-lg p-2">
                    <div class="row pb-2">
                        <div class="col">
                            <h2 class="fs-2 fw-bold">Pesanan Anda</h2>
                        </div>
                        <div class="col text-end">
                            <a class="btn btn-info" href="{{ route('pesanan.create') }}">Buat Pesanan</a>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nama Toko</th>
                                <th scope="col">Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanans as $pesanan)
                            <tr>
                                <td class="text-center">{{ $pesanan->id }}</td>
                                <td>{{ $pesanan->tokos->name }}</td>
                                <td>{{ $pesanan->tokos->address }}</td>
                            </tr>
                            @endforeanch
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
