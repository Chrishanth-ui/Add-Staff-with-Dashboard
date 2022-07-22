<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Accountant;


class AccountantData extends Component
{

    public $Accountant_name;
    public $Accountant_number;
    public $Accountant_email;
    public $Accountant_address;
    public $list_data=[];
    public $Accountant_id = 0;
    
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
        // echo $this->Accountant_medium;
        # code...
        if ($this->Accountant_id == 0) {
        $data=new Accountant();
        $data->name=$this->Accountant_name;
        $data->number=$this->Accountant_number;
        $data->email=$this->Accountant_email;
        $data->address=$this->Accountant_address;
        $data->save();
        $this->clearData();
        } else {
            $data = Accountant::find($this->Accountant_id);
            $data->name=$this->Accountant_name;
            $data->number=$this->Accountant_number;
            $data->email=$this->Accountant_email;
            $data->address=$this->Accountant_address;
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
        $this->Accountant_name="";
        $this->Accountant_number="";
        $this->Accountant_email="";
        $this->Accountant_address="";
        $this->Accountant_id = 0;
        $this->dispatchBrowserEvent('hide-form');
        // $this->dispatchBrowserEvent('hide-form-edit');  
        
        
    }

    public function fetchData()
    {
        # code...
        

        if ($this->search_key) {
            #search by key
            $this->list_data=Accountant::where('name', 'LIKE', '%' . $this->search_key . '%')->get();
        } else {
        
            $this->list_data=Accountant::all();
        }
    }

    #update
    public function updateData($id)
    {
        # code...
        $data = Accountant::find($id);
        $this->Accountant_name = $data->name;
        $this->Accountant_number = $data->number;
        $this->Accountant_email = $data->email;
        $this->Accountant_address = $data->address;
        $this->Accountant_id = $id;
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
            $data = Accountant::find($this->delete_id);
            $data->delete();
           
        }
        $this->delete_id=0;
        $this->dispatchBrowserEvent('hide-delete-form'); 
    }

    public function render()
    {
        $this->fetchData();
        return view('livewire.accountant-data')->layout('layouts.navigation');
    }
}
