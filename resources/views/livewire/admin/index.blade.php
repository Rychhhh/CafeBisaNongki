<div>
    <div class="card-body px-0 pb-2">
      <div class="input-group w-25 m-2">
        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
        <input wire:model="search" type="text" class="form-control"  placeholder="Type here...">
      </div>

        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <thead >
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Email</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Password</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
              </tr>
            </thead>
            <tbody class="text-center">
              
             @forelse ($users as $item)
              <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm"> {{ ucfirst($item->name) }}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-xs font-weight-bold"> {{ $item->email }}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> {{ $item->password }} </span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> {{ ucfirst($item->role) }} </span>
                  </td>
                  
                  <td class="align-middle text-center text-sm">
                    <a class="btn btn-primary mx-3" wire:click.prevent="edit({{ $item->id }})">Edit</span>
                    <a class="btn btn-danger" wire:click.prevent="confirmdelete({{ $item->id }})">Delete</span>
                  </td>
                </tr>
             @empty
               <tr class="text-info  mx-auto mt-5">
                 <td> 
                   <h3> Maaf Data Kosong </h3> 
                  </td>
                </tr>
             @endforelse

            </tbody>
          </table>

        </div>
      </div>

      <div class="parent col p-5 d-flex justify-content-center m-5  btn btn-light text-dark">
                          
        <div class="child overflow-hidden" style="height: 25px;">
          {{ $users->links() }}
        </div>
        
      </div>


      
    {{-- Modal --}}

  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">

      {{-- Submit Prevent edit and add --}}
      <form autocomplete="off" wire:submit.prevent="updateUser">
        <div class="modal-content">
          <div class="modal-header">  
            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">X</button>
          </div>
          <div class="modal-body">

            <form>

              <div class="mb-3">
                <label for="name" class="col-form-label">Name :</label>
                <input type="text" wire:model.defer="name" class="form-control @error('name') is-invalid @enderror" name="name" autofocus>

                {{-- Error Message --}}
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror

              </div>
              

              <div class="mb-3">
                <label for="email" class="col-form-label">Email:</label>
                <input type="email" wire:model.defer="email"  class="form-control @error('email') is-invalid @enderror" name="email">

                {{-- Error Message --}}
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror

              </div>

              @php
                  $roles = ['kasir', 'manager', 'admin'];
              @endphp

              <div class="mb-3">
                <label for="role" class="col-form-label">Role :</label>
                <select class="form-select" aria-label="Default select example" wire:model.defer="role" name="role">

                  @foreach ($roles as $role)
                    <option
                    @if ($role === Auth::user()->role)
                        selecteds
                    @endif

                    >{{ ucfirst($role) }}</option>
                  @endforeach
                </select>

                {{-- Error Message --}}
                @error('role')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror

              </div>

            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>

