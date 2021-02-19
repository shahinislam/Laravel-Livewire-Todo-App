<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TodoComponent extends Component
{
    public $todoText;
    public $check;
    public $checkCross;
    public $text;
    public $todoArray = [];
    public $todoInput;
    public $leftItem = 0;
    public $showAll = true;
    public $showActiveOrCompleted;
    public $selected = 1;

    public function addTodo()
    {
        if( ! $this->todoText)
        {
            return;
        }
        
        $this->todoArray[] = [
            'text' => $this->todoText,
            'cross' => false,
            'showInput' => false,
        ];
        $this->todoText = '';
        $this->leftItem++;
    }

    public function checkCross($index)
    {
        $arrayCross = $this->todoArray[$index]['cross'];

        $arrayCross == true ?  $this->leftItem++ : $this->leftItem--;

        $this->todoArray[$index]['cross'] = $arrayCross == false ?  true : false;
    }

    public function edit($index)
    {
        $text = $this->todoArray[$index]['text'];

        $this->todoInput[$index] = $text;

        $this->todoArray[$index]['showInput'] = true;
    }

    public function update($index)
    {
        $this->todoArray[$index]['text'] = $this->todoInput[$index];

        $this->todoInput[$index] = '';

        $this->todoArray[$index]['showInput'] = false;
    }

    public function all()
    {
        $this->showAll = true;
        $this->selected = 1;
    }

    public function active()
    {
        $this->showAll = false;
        $this->showActiveOrCompleted = false;
        $this->selected = 2;
    }
    
    public function completed()
    {
        $this->showAll = false;
        $this->showActiveOrCompleted = true;
        $this->selected = 3;
    }

    public function delete($index)
    {
        if($this->todoArray[$index]['cross'] == false)
        {
            $this->leftItem--;
        }
        unset($this->todoArray[$index]);
    }

    public function clearCompleted()
    {
        foreach($this->todoArray as $i => $array)
        {
            if($array['cross'])
            {
                unset($this->todoArray[$i]);
            }
        }
    }

    public function render()
    {
        return view('livewire.todo-component');
    }
}
