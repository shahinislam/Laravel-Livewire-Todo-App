<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoComponent extends Component
{
    public $todoText;
    public $check;
    public $checkCross;
    public $text;
    public $todoInput;
    public $leftItem;
    public $showAll = true;
    public $showActiveOrCompleted;
    public $selected = 1;

    public function mount()
    {
        $this->leftItem = Todo::where('cross', false)->count('cross');
    }

    public function addTodo()
    {
        if( ! $this->todoText)
        {
            return;
        }

        Todo::create( [
            'text' => $this->todoText,
            'cross' => false,
            'show_input' => false,
        ]);
        
        $this->todoText = '';
        $this->leftItem++;
    }

    public function checkCross($id)
    {
        $isCross = Todo::find($id)->cross;

        $isCross == true ?  $this->leftItem++ : $this->leftItem--;

        $value = $isCross == false ?  true : false;

        Todo::find($id)->update([
            'cross' => $value,
        ]);
    }

    public function edit($id)
    {
        $text = Todo::find($id)->text;

        $this->todoInput[$id] = $text;

        Todo::find($id)->update([
            'show_input' => true,
        ]);
    }

    public function update($id)
    {
        Todo::find($id)->update([
            'text' => $this->todoInput[$id],
        ]);

        $this->todoInput[$id] = '';

        Todo::find($id)->update([
            'show_input' => false,
        ]);
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

    public function delete($id)
    {
        $isCross = Todo::find($id)->cross;

        if($isCross == false)
        {
            $this->leftItem--;
        }

        Todo::find($id)->delete();
    }

    public function clearCompleted()
    {
        $todoArray = Todo::all();

        foreach($todoArray as $i => $array)
        {
            if($array->cross)
            {
                Todo::find($array->id)->delete();
            }
        }
    }

    public function render()
    {
        $todoArray = Todo::all();

        return view('livewire.todo-component', compact('todoArray'));
    }
}
