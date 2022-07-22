<div>
    <div class="container" style="margin-top: 40px;">

        <!--Code to dispaly the add button and the h2 tag in below div-->

        <div class="d-flex justify-content-center">
            <!--Table title-->
            <h2 class="">Employees</h2>
        </div>

        

        <!--Add button showfrom function and text div-->
        <div class="d-flex justify-content-end" style="margin-bottom: 10px">
            {{-- <h6 class="mt-2"> Add a new Cateory here </h6> --}}
            <button class="btn btn-primary ml-3 bg-success" wire:click='addNew'>ADD <i class="remove ti-plus"></i></button>
        </div>



        
        <!--Breadcrumbs-->
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="#">Staff</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Employee</li>
                </ol>
              </nav>

               <!--Code to dispaly the data in table by search-->
                <div class="d-flex justify-content-end  " style="padding-left:40px;">
                <input class="border border-primary" style="border-radius: 5px; padding-left: 5px" type="text" placeholder="  Search"
                wire:model="search_key">
                </div>

        </div>

        <div class="table-responsive mt-2"
            style="display: grid; text-align: center;">
            <table class="table table-bordered" >
                <thead>
                    <tr class="bg-primary text-white" style=" text-align: center;">
                        <!--column names-->
                        <th>No</th>
                        <th>Name</th>
                        <th>Duty</th>
                        <th>Number</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php($count = 1)
                    @foreach ($list_data as $row)
                        <!--Code to dispaly the insert data form section below-->
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->work }}</td>
                            <td>{{ $row->number }}</td>
                            <td>{{ $row->address }}</td>
                            <td>
                                <!--Edit button with edit function in insert.php-->
                                <button class="btn btn-success ml-5 rounded"
                                    wire:click='updateData({{ $row->id }})'> <i class="remove ti-pencil"></i></button>
                                <!--Delete button with delete function in insert.php-->
                                <button class="btn btn-danger ml-4 rounded"
                                    wire:click='showDelete({{ $row->id }})'><i class="remove ti-trash"></i></button>

                                
                            </td>
                        </tr>
                        @php($count++)
                    @endforeach
                </tbody>
            </table>
        </div>



        {{-- delete model --}}
        <div>
            <div class="row mt-5">
                <div class="col-md-6 offset-3">
                    <div class="modal fade" id="delete" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true close-btn">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you wanna delete?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary close-btn"
                                        data-dismiss="modal">Cancel</button>
                                    <button type="button" wire:click='deleteData'
                                        class="btn btn-danger close-modal">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        {{-- create model --}}
        <div>
            <div class="row mt-5">
                <div class="col-md-6 offset-3">
                    <div wire:ignore.self class="modal fade" id="form" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                                    <button type="button"  wire:click='closeCreate' class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="Employee-name" class="col-form-label">Name:</label>
                                            <input type="text" wire:model="Employee_name" class="form-control"
                                                id="recipient-name">
                                        </div>
                                        <div class="form-group">
                                            <label for="Employee-work" class="col-form-label">Work:</label>
                                            <input type="text" wire:model='Employee_work' class="form-control"
                                                id="recipient-work">
                                        </div>
                                        <div class="form-group">
                                            <label for="Employee-number" class="col-form-label">Number:</label>
                                            <input type="text" wire:model="Employee_number" class="form-control"
                                                id="recipient-number">
                                        </div>
                                        <div class="form-group">
                                            <label for="Employee-address"
                                                class="col-form-label">Address:</label>
                                            <input type="text" wire:model='Employee_address' class="form-control"
                                                id="recipient-address">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" wire:click='closeCreate' class="btn btn-secondary close-btn"
                                        data-dismiss="modal">Close</button>
                                    <button type="button" wire:click.prevent="saveData()"
                                        class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        {{-- update model --}}
        <div>
            <div class="row mt-5">
                <div class="col-md-6 offset-3">
                    <div wire:ignore.self class="modal fade" id="modelUpdate" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modelUpdate">Edit Employee</h5>
                                    <button type="button"  wire:click='closeUpdate' class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="Employee-name" class="col-form-label">Name:</label>
                                            <input type="text" wire:model="Employee_name" class="form-control"
                                                id="recipient-name">
                                        </div>
                                        <div class="form-group">
                                            <label for="Employee-work" class="col-form-label">Work:</label>
                                            <input type="text" wire:model='Employee_work' class="form-control"
                                                id="recipient-work">
                                        </div>
                                        <div class="form-group">
                                            <label for="Employee-number" class="col-form-label">Number:</label>
                                            <input type="text" wire:model="Employee_number" class="form-control"
                                                id="recipient-number">
                                        </div>
                                        <div class="form-group">
                                            <label for="Employee-address"
                                                class="col-form-label">Address:</label>
                                            <input type="text" wire:model='Employee_address' class="form-control"
                                                id="recipient-address">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" wire:click='closeUpdate' class="btn btn-secondary close-btn"
                                        data-dismiss="modal">Close</button>
                                    <button type="button" wire:click.prevent="saveData()"
                                        class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>

<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
</div>

