<?php

namespace App\Livewire;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserComponent extends Component
{
    use WithPagination,WithoutUrlPagination;
    protected $paginationTheme='bootstrap';
    public $name, $email, $password, $id, $cari, $role;
    public function render()
    {
        $layout['title']="Kelola User";
        if($this->cari!=""){
            $data['user'] = User::where('name','like','%'.$this->cari . '%')->paginate(10);
        }else{
            $data['user'] = User::paginate(10);
        }
        
        return view('livewire.user-component', $data)->layoutData($layout);
    }
    public function store(){
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role'=>'admin'
            
        ]);
        session()->flash('succes','berhasil simpan');
        $this->reset();
    }
    public function edit($id)
    {
        $user = User::find($id);
        $this->name=$user->name;
        $this->email=$user->email;
        $this->role=$user->role;
        $this->id=$user->id;
    }
    public function update()
    {
        $user = User::find($this->id);
        if($this->password==""){
             $user->update([
                'name'=>$this->name,
                'email'=>$this->email,
                'role'=>$this->role
             ]);
        }else{
            $user->update([
                'name'=>$this->name,
                'email'=>$this->email,
                'password'=>$this->password,
                'role'=>$this->role
             ]);
        }
        session()->flash('success','berhasil Ubah');
        $this->reset();
    }
    public function confirm($id){
        $this->id = $id;
    } 
    public function destroy()
    {
        $user=User::find($this->id);
        $user->delete();
        session()->flash('success','berhasil hapus');
        $this->reset();
    }
}
