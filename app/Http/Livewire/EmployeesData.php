<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Employee;


class EmployeesData extends Component
{

    public $Employee_name;
    public $Employee_work;
    public $Employee_number;
    public $Employee_address;
    public $list_data=[];
    public $Employee_id = 0;
    
    public $search_key;
    public $delete_id=0;

    public function addNew() 
    {
        # code...
        // return dd('here');
        $this->dispatchBrowserEvent('show-form');
    }

    public function saveData()
    {
        // echo $this->Employee_medium;
        # code...
        if ($this->Employee_id == 0) {
        $data=new Employee();
        $data->name=$this->Employee_name;
        $data->work=$this->Employee_work;
        $data->number=$this->Employee_number;
        $data->address=$this->Employee_address;
        $data->save();
        $this->clearData();
        } else {
            $data = Employee::find($this->Employee_id);
            $data->name=$this->Employee_name;
            $data->work=$this->Employee_work;
            $data->number=$this->Employee_number;
            $data->address=$this->Employee_address;
            $data->save();
            $this->dispatchBrowserEvent('hide-form-edit');   
            $this->clearData();
        }
    }

    #Close update modal
    public function closeUpdate()
    {
        # code...
        $this->clearData();
        $this->dispatchBrowserEvent('hide-form-edit');   
          
    }


    #Close create modal
    public function closeCreate()
    {
        # code...
        $this->clearData();
        $this->dispatchBrowserEvent('hide-form');

    }

    public function clearData()
    {
        # code...
        $this->Employee_name="";
        $this->Employee_work="";
        $this->Employee_number="";
        $this->Employee_address="";
        $this->Employee_id = 0;
        $this->dispatchBrowserEvent('hide-form');
        // $this->dispatchBrowserEvent('hide-form-edit');  
        
        
    }

    public function fetchData()
    {
        # code...
        

        if ($this->search_key) {
            #search by key
            $this->list_data=Employee::where('name', 'LIKE', '%' . $this->search_key . '%')->get();
        } else {
        
            $this->list_data=Employee::all();
        }
    }

    #update
    public function updateData($id)
    {
        # code...
        $data = Employee::find($id);
        $this->Employee_name = $data->name;
        $this->Employee_work = $data->work;
        $this->Employee_number = $data->number;
        $this->Employee_address = $data->address;
        $this->Employee_id = $id;
        $this->dispatchBrowserEvent('show-form-edit');
       
    }

    #show Delete modal
    public function showDelete($id) 
    {
        # code...
        // return dd('here');
        $this->delete_id=$id;
        $this->dispatchBrowserEvent('show-delete-form');
    }

    #delete
    public function deleteData()
    {
        # code...
        if($this->delete_id!=0){
            $data = Employee::find($this->delete_id);
            $data->delete();
           
        }
        $this->delete_id=0;
        $this->dispatchBrowserEvent('hide-delete-form'); 
    }

    public function render()
    {
        $this->fetchData();
        return view('livewire.employees-data')->layout('layouts.navigation');
    }
}
