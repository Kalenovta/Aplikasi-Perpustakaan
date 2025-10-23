<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\User;

class MemberComponent extends Component
{
    use WithPagination,WithoutUrlPagination;
    protected $paginationTheme='bootstrap';
    public $name,$email,$password,$cari,$id;
    public function render()
    {
        if($this->cari!=""){
            $data['member']=User::where('name', 'like','%'. $this->cari . '%')
            ->paginate(10);
        }else{
            $data['member']=User::where('role','siswa')->paginate(10);
        }
        $layout['title'] = 'Kelola Siswa';
        return view('livewire.member-component', $data)->layoutData($layout);
    }
    public function store(){
        $this->validate([
            'name'=>'required',
            'email'=>'email|required',
            'password'=>'required'
            
        ]);
        User::create([
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>Hash::make($this->password),
            'role'=>'siswa'
        ]);
        session()->flash('success','Berhasil');
        return redirect()->route('member');
    }
    public function edit($id){
        $member=User::find($id);
        $this->id = $member->id;
        $this->name = $member->name;
        $this->email = $member->email;
    }
     public function update()
    {
        $user = User::find($this->id);
        if($this->password==""){
             $user->update([
                'name'=>$this->name,
                'email'=>$this->email
             ]);
        }else{
            $user->update([
                'name'=>$this->name,
                'email'=>$this->email,
                'password'=>$this->password
             ]);
        }
        session()->flash('success','berhasil Ubah');
        $this->reset();
    } 
    public function confirm($id){
        $this->id = $id;
    }
    public function destroy(){
        $member=User::find($this->id);
        $member->delete();
        session()->flash('success','berhasil hapus');
        return redirect()->route('member');
    }
}
