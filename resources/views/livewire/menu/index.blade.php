<div>

  <div>
      <div class="d-flex justify-content-between">
        
        <div class="input-group w-25 m-2 ">
            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
            <input wire:model="search" type="text" class="form-control"  placeholder="Type here...">
          </div>

          <a class="btn btn-success mt-2" href="{{ url('menu/create') }}">Add</a>

      </div>


      <div class="row row-cols-2 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 g-4">

            @forelse ($menu as $item)
                <div class="card p-2 " style="width: 18rem;">
                  <img class="card-img-top" height="150px" src="{{ asset('storage/menu/'. $item->photo ) }}" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">{{ $item->nama_menu }}</h5>
                    <sub class="text-bold">Stok : {{ $item->stok }}</sub>
                    <p class="card-text">Rp.{{ number_format($item->harga) }}</p>
                    <p class="card-text"><span class="font-bold">Desc : </span> {{ $item->desc }}</p>
                    <a href="{{ url('menu/'. $item->id .'/edit') }}" class="btn btn-primary">Edit</a>
                    <a wire:click.prevent="confirmdelete({{ $item->id }})" class="btn btn-danger">Delete</a>
                  </div>
                </div>
            @empty
                <h3 class="text-info mx-auto mt-5">Maaf Data Kosong</h3>
            @endforelse

      </div>

        
       
      </div>

          <div class="parent col p-5 d-flex justify-content-center m-5  btn btn-light text-dark">
                          
            <div class="child overflow-hidden" style="height: 25px;">
              {{ $menu->links() }}
            </div>
            
          </div>

    </div>
    
</div> 




