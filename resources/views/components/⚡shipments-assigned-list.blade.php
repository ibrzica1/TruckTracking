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

    public function validateAmount(){
        if($this->amount < 1){
            $this->addError('validateAmount', 'Amount cant be below 1');
        }
    }
};
?>

<div>
    @error('validateAmount')
        <p>{{$message}}</p>
    @enderror
    
    <p>Clicked Times: <span class="{{$count>500 ? 'red' : ''}}">{{$count}}</span></p>
    <button wire:click="increment">Add</button>
    <button wire:click="subtrack">Subtrack</button>
    <input type="number" min=1 wire:blur='validateAmount' wire:model.live="amount">
    <p>Amount: {{$amount}}</p>

    <style>
        .red {color: red;}
    </style>
</div>