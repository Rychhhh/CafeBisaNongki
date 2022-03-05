<div>
    <div>
        <div class="row my-4">
            <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
              <div class="card">
                <div class="card-header pb-0 ">

                  <div class="row flex justify-content-between">
                    <div class="col-lg-6 col-7">
                      <h6>Transaksi</h6>
                    </div>
                    <div class="col-lg-2 col-7">
                        
                      <button class="btn btn-success" type="button" wire:click.prevent='add'>Transaksi</button>
                    </div>
                  </div>

                </div>
                <div class="card-body px-0 pb-2">
                  <div class="table-responsive">
                    <table class="table align-items-center mb-0 w-full">
                      <thead >
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Menu</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Nama Pelanggan</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pegawai</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        
                         @forelse ($transaksi as $kasir)
                            <tr>
                              <td>
                                <div class="d-flex px-2 py-1">
                                  <div>
                                    <img src="{{ asset('img/small-logos/logo-xd.svg') }}" class="avatar avatar-sm me-3" alt="xd">
                                  </div>
                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm"> {{ ucfirst($kasir->nama_menu) }}</h6>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <span class="text-xs font-weight-bold"> {{ ucfirst($kasir->nama_pelanggan) }}</span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold"> {{ $kasir->jumlah }} </span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold"> Rp {{ number_format($kasir->total_harga) }} </span>
                              </td>
            
                              <td class="align-middle text-center text-sm">
                                <span class="text-xd font-weight-bold">{{ ucfirst($kasir->nama_pegawai) }}</span>
                              </td>
                              
                              <td class="align-middle text-center text-sm">
                                <a class="btn btn-primary mx-3" wire:click.prevent="edit({{ $kasir->id }})">Edit</span>
                                <a class="btn btn-danger" wire:click.prevent="deleteConfirm({{ $kasir->id }})">Delete</span>
                              </td>
                            </tr>
                         @empty
                             <h3 class="text-info  mx-auto mt-5">Maaf Data Kosong</h3>
                         @endforelse

                      </tbody>
                    </table>
                        
                    <div class="parent col p-5 d-flex justify-content-center m-5  btn btn-light text-dark">
                      
                      <div class="child overflow-hidden" style="height: 25px;">
                        {{ $transaksi->links() }}
                      </div>
                      
                    </div>


        
                  </div>
                </div>
              </div>
            </div>
        
          </div>
    </div>
    



    {{-- Modal --}}

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">

      {{-- Submit Prevent edit and add --}}
      <form  wire:submit.prevent="{{ $showEditModal ? 'updateTransaksi' : 'createTransaksi' }}">
        
        <div class="modal-content">
          <div class="modal-header">  
            <h5 class="modal-title" id="exampleModalLabel">{{ $showEditModal ? 'Edit Transaksi' : 'Add Transaksi' }}</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">X</button>
          </div>
          <div class="modal-body">
            <form>

              <div class="mb-3">
                <label for="nama_pelanggan" class="col-form-label">Nama Pelanggan:</label>
                <input type="text" wire:model.defer="nama_pelanggan" placeholder="Example : John"  class="form-control @error('nama_pelanggan') is-invalid @enderror" name="nama_pelanggan">

                {{-- Error Message --}}
                @error('nama_pelanggan')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror

              </div>
              

              <div class="mb-3">
                <label for="nama_menu" class="col-form-label">Nama Menu:</label>
                {{-- <input type="text" wire:model.defer="nama_menu" placeholder="Example : Kopi"  class="form-control @error('nama_menu') is-invalid @enderror" name="nama_menu"> --}}

                <select wire:change="pilihMenu" class="form-select" aria-label="Default select example" wire:model.defer="nama_menu" name="nama_menu">

                  @php
                     use App\Models\Menu;
                      $menu = Menu::all();
                  @endphp

                  <option selected>...</option>
                  @foreach ($menu as $item)
                    <option>{{ $item->nama_menu }}</option>
                  @endforeach
                </select>

                {{-- Error Message --}}
                @error('nama_menu')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror

              </div>

              <div class="mb-3">
                <label for="jumlah" class="col-form-label">Jumlah :</label>
                <input type="number" id="jumlahPesanan" placeholder="1 Or 2" wire:model.defer="jumlah"  class="form-control @error('jumlah') is-invalid @enderror" name="jumlah">

                {{-- Error Message --}}
                @error('jumlah')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror

              </div>

              <div class="input-group mb-3 flex flex-col">
                <span class="input-group-text">Harga Per Unit.</span>
                <span class="input-group-text">Rp.</span>
                <input disabled type="number" id="hargaperunit" class="form-control" >
              </div>

              {{-- Total Harga --}}
              <label for="total_harga" class="col-form-label">Total Harga :</label>
              <div class="input-group mb-3 flex flex-col">
                  <span class="input-group-text">Rp.</span>
                  <input type="number" wire:model.defer="total_harga" placeholder="Ingat Harga Ini" class="form-control @error('total_harga') is-invalid @enderror" aria-label="Amount (to the nearest dollar)" id="harga_menu" name="total_harga">

                  <span class="input-group-text">.00</span>

                  {{-- Error Message --}}
                  @error('total_harga')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>

             

              <div class="mb-3">
                <label for="nama_pegawai" class="col-form-label">Nama Pegawai :</label>
                <select class="form-select" aria-label="Default select example" wire:model.defer="nama_pegawai" name="nama_pegawai">

                  <option selected>...</option>
                  @foreach ($users as $item)
                    <option>{{ $item->name }}</option>
                  @endforeach
                </select>

                {{-- Error Message --}}
                @error('nama_pegawai')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror

              </div>

            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">{{ $showEditModal ? 'Save Changes' : 'Save' }}</button>
          </div>
        </div>
      </form>

    </div>
  </div>

</div>


</div>
