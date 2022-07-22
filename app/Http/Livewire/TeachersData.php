<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Teacher;

class TeachersData extends Component
{

    public $Teacher_name;
    public $Teacher_subject;
    public $Teacher_medium = [];
    public $Teacher_number;
    public $Teacher_qualify;
    public $list_data=[];
    public $teacher_id = 0;
    
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
        // echo $this->Teacher_medium;
        # code...
        if ($this->teacher_id == 0) {
        $data=new Teacher();
        $data->name=$this->Teacher_name;
        $data->subject=$this->Teacher_subject;
        $data->medium= str_replace('[', '', str_replace(']', '', json_encode($this->Teacher_medium)));
        $data->number=$this->Teacher_number;
        $data->qualification=$this->Teacher_qualify;
        $data->save();
        $this->clearData();
        } else {
            $data = Teacher::find($this->teacher_id);
            $data->name=$this->Teacher_name;
            $data->subject=$this->Teacher_subject;
            $data->medium= str_replace('[', '', str_replace(']', '', json_encode($this->Teacher_medium)));
            $data->number=$this->Teacher_number;
            $data->qualification=$this->Teacher_qualify;
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
        $this->Teacher_name="";
        $this->Teacher_subject="";
        $this->Teacher_medium = [];
        $this->Teacher_number="";
        $this->Teacher_qualify="";
        $this->teacher_id = 0;
        $this->dispatchBrowserEvent('hide-form');
        // $this->dispatchBrowserEvent('hide-form-edit');  
        
        
    }

    public function fetchData()
    {
        # code...
        

        if ($this->search_key) {
            #search by key
            $this->list_data=Teacher::where('name', 'LIKE', '%' . $this->search_key . '%')->get();
        } else {
        
            $this->list_data=Teacher::all();
        }
    }

    #update
    public function updateData($id)
    {
        # code...
        $data = Teacher::find($id);
        $this->Teacher_name = $data->name;
        $this->Teacher_subject = $data->subject;
        $this->Teacher_medium = json_decode('['. $data->medium . ']');
        $this->Teacher_number = $data->number;
        $this->Teacher_qualify = $data->qualification;
        $this->teacher_id = $id;
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
            $data = Teacher::find($this->delete_id);
            $data->delete();
           
        }
        $this->delete_id=0;
        $this->dispatchBrowserEvent('hide-delete-form'); 
    }

    public function render()
    {
        $this->fetchData();
        return view('livewire.teachers-data')->layout('layouts.navigation');
    }
}
