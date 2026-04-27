<?php

use Livewire\Component;

new class extends Component
{
    public int $count = 0;

    public function increment(){
        $this->count++;
    }

    public function subtrack(){
        if($this->count > 0){
            $this->count--;
        }
    }
};
?>

<div>
    <p>Clicked Times: {{$count}}</p>
    <button wire:click="increment">Add</button>
    <button wire:click="subtrack">Subtrack</button>
</div>