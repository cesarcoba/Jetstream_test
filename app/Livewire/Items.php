<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use Livewire\WithPagination;

class Items extends Component
{
    use WithPagination;

    public $active;
    public $q;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $test = "Hola";
    public $id;
    // public $item = [];
    public $item;
    // public Item $item;

    public $confirmingItemDeletion = false;
    public $confirmingItemAdd = false;


    protected $queryString = [
        'active' => ['except' => false],
        'q' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true],
    ];

    protected $rules = [
        'item.name' => 'required|string|min:4',
        'item.price' => 'required|numeric|between:1,100',
        'item.status' => 'boolean'
    ];

    public function render()
    {
        // dd($this->active);
        $items = Item::where('user_id', auth()->user()->id)
            ->when($this->q, function( $query) {
                return $query->where(function( $query){
                    $query->where('name','like','%'.$this->q.'%')
                    ->orwhere('price','like','%'.$this->q.'%');
                });
            })
            ->when($this->active, function( $query){
                return $query->active();
                // return $query->where('status', 1);
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC');

        $query = $items->toSql();
        $items = $items->paginate(5);
        return view('livewire.items',[
            'items'=> $items,
            'query'=>$query
        ]);
    }

    public function updatingActive()
    {
        $this->resetPage();
    }

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function ordenaBy($field)
    {
        if($field == $this->sortBy){
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
    }
    public function test1($ok)
    {
        dump($ok);
    }

    public function confirmItemDeletion($id)
    {
        // $item->delete();
        $this->confirmingItemDeletion = $id;
    }

    public function deleteItem(Item $item){
        $item->delete();
        $this->confirmingItemDeletion = false;
        session()->flash('message', 'Item Deleted Successfully');
    }

    public function confirmItemAdd()
    {
        // $item->delete();
        $this->reset(['item']);
        $this->confirmingItemAdd = true;
    }

    public function confirmItemEdit(Item $item){

        $this->item = $item;
        // $this->item = Item::where('id','=',$item);
        // $this->fill($this->item);

        $this->confirmingItemAdd = true;
        dump($this->item->name);

    }

    public function saveItem(){
        dump("en el saveItem");
        $this->validate();

        if(isset($this->item->id)){
            $this->item->save();
            session()->flash('message','Item Saved Successfully');
        }else{

            auth()->user()->items()->create([
                'name'=>$this->item['name'],
                'price'=>$this->item['price'],
                'status' => $this->item['status']??0
            ]);

            session()->flash('message', 'Item Added Successfully');
        }
        $this->confirmingItemAdd = false;

    }

    public function sobre($id){
        // dump ("ok ok");
        $this->id = $id;
    }

}
