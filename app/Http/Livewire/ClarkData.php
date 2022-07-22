<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Clark;

class ClarkData extends Component
{

    public $Clark_name;
    public $Clark_number;
    public $Clark_email;
    public $Clark_address;
    public $list_data=[];
    public $Clark_id = 0;
    
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
        // echo $this->Clark_medium;
        # code...
        if ($this->Clark_id == 0) {
        $data=new Clark();
        $data->name=$this->Clark_name;
        $data->number=$this->Clark_number;
        $data->email=$this->Clark_email;
        $data->address=$this->Clark_address;
        $data->save();
        $this->clearData();
        } else {
            $data = Clark::find($this->Clark_id);
            $data->name=$this->Clark_name;
            $data->number=$this->Clark_number;
            $data->email=$this->Clark_email;
            $data->address=$this->Clark_address;
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
        $this->Clark_name="";
        $this->Clark_number="";
        $this->Clark_email="";
        $this->Clark_address="";
        $this->Clark_id = 0;
        $this->dispatchBrowserEvent('hide-form');
        // $this->dispatchBrowserEvent('hide-form-edit');  
        
        
    }

    public function fetchData()
    {
        # code...
        

        if ($this->search_key) {
            #search by key
            $this->list_data=Clark::where('name', 'LIKE', '%' . $this->search_key . '%')->get();
        } else {
        
            $this->list_data=Clark::all();
        }
    }

    #update
    public function updateData($id)
    {
        # code...
        $data = Clark::find($id);
        $this->Clark_name = $data->name;
        $this->Clark_number = $data->number;
        $this->Clark_email = $data->email;
        $this->Clark_address = $data->address;
        $this->Clark_id = $id;
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
            $data = Clark::find($this->delete_id);
            $data->delete();
           
        }
        $this->delete_id=0;
        $this->dispatchBrowserEvent('hide-delete-form'); 
    }

    public function render()
    {
        $this->fetchData();
        return view('livewire.clark-data')->layout('layouts.navigation');
    }
}
