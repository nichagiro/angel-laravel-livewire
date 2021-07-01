<?php

namespace App\Http\Livewire\Blogs;

use App\Events\NotificationBlogEvent;
use App\Http\Controllers\DeleteImgController;
use App\Models\blog;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class IndexBlogsLivewire extends Component 
{
    use WithPagination;
    use WithFileUploads;
    
    public $modal = false;
    public $modal_delete = false;
    public $modal_update = false;
    public $blog = [];
    public $blog_delete = [];
    public $blog_update = [];
    public $img_update;
    public $search;
    protected $queryString = ['search'];

    protected $rules = [
        "blog.title" => 'required | min:5',
        "blog.body"  => 'required | min:10',
        "blog.img" => 'required | image'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function mount(){

    // Encryptacion con has y encrypt
    //   $name = "angel y nicolas";

    //   $encryp = Crypt::encrypt($name);
    //   $descryp = Crypt::decrypt($encryp);
        
    //   dd($encryp, $descryp, Hash::make($name));

    if(Session::missing('filtro')){
        Session::put('filtro',Auth::user()->name);
    }

    $this->search = session::get('filtro');


    $this->page = session::get('paginate');
        
    }

    public function render()
    {

        Session::put('filtro', $this->search);

        $blogs = blog::join('users','users.id', '=', 'blogs.users_id')
        ->select('blogs.id','blogs.title','blogs.body','blogs.img','blogs.users_id',
        'users.name as autor', 'users.email as correo')
        ->where('blogs.title', 'like', '%'.$this->search.'%')
        ->orWhere('users.name', 'like', '%'.$this->search.'%')
        ->orWhere('users.email', 'like', '%'.$this->search.'%')
        ->latest('id')
        ->paginate(5);

        return view('livewire.blogs.index-blogs-livewire', compact('blogs'));
    }

    public function UpdateBlog(){

        if($this->img_update != ""){

            try {

                $url = DeleteImgController::CreateImg($this->img_update);

                try {

                    DeleteImgController::DeleteImg($this->blog_update["img"]);
    
                } catch (\Throwable $th) {

                    session()->flash('status', true);
                    session()->flash('msg', 'No se pudo eliminar la imagen vieja');
                    session()->flash('bg', 'purple');
                    
                }

            } catch (\Throwable $th) {

                session()->flash('status', true);
                session()->flash('msg', 'No se pudo guardar la nueva foto');
                session()->flash('bg', 'pink');

            }

        } 
        
        else {

            $url = $this->blog_update["img"];

        }


        try {

            $blog = blog::find($this->blog_update["id"]);
          
            $blog->update([
                "title" => $this->blog_update["title"],
                "body" => $this->blog_update["body"],
                "users_id" => $this->blog_update["users_id"], 
                "img" => $url
            ]);

            session()->flash('status', true);
            session()->flash('msg', 'Se actualizo el blog '.$this->blog_update['title']);
            session()->flash('bg', 'indigo');
            
            
        } catch (\Throwable $th) {
            
            session()->flash('status', true);
            session()->flash('msg', 'No se puedo guardar el registro');
            session()->flash('bg', 'red');
        }

        // EVENTS
        NotificationBlogEvent::dispatch($blog);


       $this->modal_update = false;
       $this->reset("blog_update");

        
    }

    public function modalUpdate($blog = ""){

        $this->blog_update = $blog;
        $this->modal_update = !$this->modal_update;

    }

    public function modalCreate(){

        $this->modal = !$this->modal;

    }

    public function modal_delete($blog){
        
        $this->modal_delete = !$this->modal_delete;
        $this->blog_delete = $blog;

    }

    public function downloadImage(blog $blog){

        $img = $blog->img;

        $url = Str::replaceFirst('storage', 'public', $img);


        try {

            return Storage::download($url);

            session()->flash('status', true);
            session()->flash('msg', 'Descargado');
            session()->flash('bg', 'purple');
            
        } catch (\Throwable $th) {
            
            session()->flash('status', true);
            session()->flash('msg', 'No se pudo descargar');
            session()->flash('bg', 'pink');

        }

    }

    public function DeleteBlog(){

        $blog = blog::find($this->blog_delete['id']);

        $autorize = Gate::allows('delete', $blog);
        
        if($autorize){

            $response = DeleteImgController::DeleteImg($this->blog_delete['img']);
       
            if($response){
     
             try {
     
                 blog::destroy($this->blog_delete);   
                 
                 session()->flash('status', true);
                 session()->flash('msg', 'El blog '.$this->blog_delete['title'].' ha sido eliminado');
                 session()->flash('bg', 'indigo');
                 
                 $this->reset('blog_delete');
                 $this->modal_delete = false;
     
             }
              catch (\Throwable $th) {
                 
                 session()->flash('status', true);
                 session()->flash('msg', 'Ocurrio un error al eliminar el blog');
                 session()->flash('bg', 'red');
         
             }
     
            }
            else{
               
             session()->flash('status', true);
             session()->flash('msg', 'Ocurrio un error al eliminar la imagen');
             session()->flash('bg', 'red');
     
            }
         
        }
        else {
           
            session()->flash('status', true);
            session()->flash('msg', 'No esta autorizado para eliminar un blog diferente');
            session()->flash('bg', 'pink');

            $this->modal_delete = false;

        }


    }

    public function StoreBlog() {

        $this->validate();

        try {
            
            $img =  $this->blog['img']->store('public/blogs');
            $url = Storage::url($img);
            
            blog::create([
                "users_id" => Auth::user()->id,
                "title" => $this->blog['title'],
                "body" => $this->blog['body'],
                "img" => $url,
            ]);

            
            session()->flash('status', true);
            session()->flash('msg', $this->blog['title'].' se creo');
            session()->flash('bg', 'green');

        } catch (\Throwable $th) {
           
            session()->flash('status', true);
            session()->flash('msg', 'Ocurrio un error');
            session()->flash('bg', 'red');
       
        }


        $this->modalCreate();
        $this->reset('blog');
 
    }


    function FiltroAutor($autor){

        $this->search = $autor;

    }

    function RouteShowBlog($id){

        Session::put('paginate', $this->page);
        redirect()->route('blog', $id);

    }

}
