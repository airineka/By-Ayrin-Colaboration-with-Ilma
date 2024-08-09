<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Toko dan Pesanan') }}
      </h2>
    </x-slot>
    
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
          <div class="row pb-2">
            <div class="col">
              <h2 class="fs-2 fw-bold">Anda telah membuat toko</h2>
            </div>
            <div class="col text-end">
              <a class="btn btn-info" href="{{ route('toko.create') }}">Buat Toko</a>
            </div>
          </div>
          <table class="table table-bordered">
            <thead class="text-center">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nama Toko</th>
              <th scope="col">Lokasi</th>
            </tr>
            </thead>
            <tbody>
            @if($toko->isEmpty())
                <tr>
                    <td colspan="3" class="text-center">Data Tidak ada</td>
                </tr>
                @else
            @foreach ($toko as $item)
              <tr>
                <th class="text-center">
                  <a href="{{ route('toko.show',$toko['id']) }}">
                      {{ $item->id }}
                  </a>
                </td>
                <td>
                    {{ $item['nama_toko'] }}
                </td>
                <td>
                    {{ $item['lokasi'] }}
                </td>
              </tr>
            @endforeach
            @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="py-1">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
          <!-- Pesanan Section -->
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
            <div class="row pb-2">
              <div class="col">
                <h2 class="fs-2 fw-bold">Daftar Pesanan</h2>
              </div>
              <div class="col text-end">
                <a class="btn btn-info" href="{{ route('pesanan.create') }}">Buat Pesanan</a>
              </div>
            </div>
            <table class="table table-bordered">
              <thead class="text-center">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama Pesanan</th>
                <th scope="col">Toko</th>
              </tr>
              </thead>
              <tbody>
              @if($pesanan)
              <tr>
                <td colspan="3" class="text-center">Data Tidak ada</td>
              </tr>
              
              @else
                @foreach ($pesanan as $item)
                  <tr>
                    <th class="text-center">
                      <a href="{{ route('pesanan.show', $item['id']) }}">
                        {{ $item->id}}
                      </a>
                    </td>
                    <td>
                      {{ $item['nama_pesanan'] }}
                    </td>
                    <td>
                      {{ $item['tanggal'] }}
                    </td>
                  </tr>
                @endforeach
              @endif  
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </x-app-layout>