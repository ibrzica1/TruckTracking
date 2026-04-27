<?php

use Livewire\Component;

new class extends Component
{
    public int $count = 0;
    public int $amount = 1;

    public function increment(){
        $this->count += $this->amount;
    }

    public function subtrack(){
        if($this->count - $this->amount > 0){
            $this->count -= $this->amount;
        }
        else{
            $this->addError('subtrack', 'Result cant be below 0');
        }
    }
};
?>

<div>
    @error('subtrack')
        <p>{{$message}}</p>
    @enderror
    
    <p>Clicked Times: {{$count}}</p>
    <button wire:click="increment">Add</button>
    <button wire:click="subtrack">Subtrack</button>
    <input type="number" min=1 wire:model.live="amount">
    <p>Amount: {{$amount}}</p>
</div>