<?php

namespace App\Http\Livewire\Helpers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component;

class HelpersLaravelLivewire extends Component
{

    protected $listeners = ['modal'];


    public $array = [
        'name' => 'Nicolas Chamorro',
        'age' => 24,
        'genero' => 'Male',
        'peso' => 72
    ];

    public $text = 'mi nombre es Nicolas Chamorro';

    public $array2;
    public $text2;
    public $users;
    
    public $accion = [
        'ArrAcc()',
        'ArrAdd()',
        'ArrPre()',
        'ArrExc()',
        'ArrExi()',
        'ArrHas()',
        'ArrFir()',
        'ArrLas()',
        'ArrFor()',
        'ArrGet()',
        'ArrOnl()',
        'ArrAso()',
        'ArrPlu()',
        'ArrRan()',
        'ArrSet()',
        'ArrShu()',
        'ArrSor()',
        'head()',
        'last()',
        'StrAft()',
        'StrBef()',
        'StrBet()',
        'StrCon()',
        'StrIs()',
        'StrFin()',
        'StrLen()',
        'StrLim',
        'StrLow()',
        'StrPB()',
        'StrPBL()',
        'StrPBR()',
        'StrPlu()',
        'StrRan()',
        'StrRem()',
        'StrRep()',
        'StrRA()',
        'StrSin()',
        'StrSlu()',
        'StrSta()',
        'StrSW()',
        'StrSub()',
        'StrSC()',
        'StrTit()',
        'StrUF()',
        'StrUpp()',
        'ruta()',
        'asset()',
        'route()',
        'url()',
        'abort()',
        'blank()',
        'filled()',
    ];

    public function modal ($name = "nicolas"){

        // se hizo un crud

        $this->dispatchBrowserEvent('modal_response', ['nombre' => $name]);

    }

    public function mount(){
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.helpers.helpers-laravel-livewire');
    }

     // comprueba si es accesible al array o matriz
     public function ArrAcc(){
        dd(Arr::accessible($this->array));
    }

    
    // Agrega datos al array
    public function ArrAdd(){
        dd(Arr::add($this->array, 'Futbolista',true));
    }

    // Agrega datos al array en el primer puesto / valor y luego columna
    public function ArrPre(){
        dd(Arr::prepend($this->array, 'Colombiano', 'Futbolista'));
    }

    // Elimina palabra clave
    public function ArrExc(){
        dd(Arr::except($this->array, 'genero'));
    }

    // Si existe en el array una columna true o false
    public function ArrExi(){
        dd(Arr::exists($this->array, 'genero'), Arr::exists($this->array, 'celular'));
    }
    // Si existe en el array una columna true o false
    public function ArrHas(){
        dd(Arr::has($this->array, 'genero'), Arr::has($this->array, 'celular'));
    }

    //trae el primer valor que cumpla con la condicion
    public function ArrFir(){
        $digits = [34, 56, 75];

        $first = Arr::first($digits, function ($value, $key) {
            return $value > 35;
        });

        dd($first);
    }

     //trae el ultimo valor que cumpla con la condicion
     public function ArrLas(){
        $digits = [34, 56, 75];

        $first = Arr::last($digits, function ($value, $key) {
            return $value > 35;
        });

        dd($first);
    }

    // Elimina campos de matricez
    public function ArrFor(){
        $array = ['products' => ['desk' => ['price' => 100]]];
        Arr::forget($array, 'products.desk');

        dd($array);
    }
    
    // trae campos 
    public function ArrGet(){
        $array = ['products' => ['desk' => ['price' => 100]]];
        dd(Arr::get($this->array, 'name'), Arr::get($array, 'products.desk', false));
    }

    // trae campos 
    public function ArrOnl(){
        $array = ['products' => ['desk' => ['price' => 100]]];
        dd(Arr::only($this->array, 'name'), Arr::get($array, 'products.desk', false));
    }

    //verifica si el array es asociativo true - false
    public function ArrAso(){
        $otro = [1,2,3,4,5,6];
        dd(Arr::isAssoc($this->array), Arr::isAssoc($otro));
    }

    // Trae los campos de un array asociativo
    public function ArrPlu(){
        dd(Arr::pluck($this->users,'name'));
    }

    // Trae un campo en random
    public function ArrRan(){
        dd(Arr::random($this->array));
    }


     // Modifica un valor de un array
     public function ArrSet(){
        dd(Arr::set($this->array, 'name', 'Angela Rojas'));
    }

    // Modifica el orden en ramdon
    public function ArrShu(){
        dd(Arr::shuffle($this->array));
    }

    // Modifica el orden alfabetico
    public function ArrSor(){
        dd(Arr::sort($this->array));
    }

    // Trae el primer valor
    public function head(){
        dd(head($this->array));
    }

    // Trae el ultimo valor
    public function last(){
        dd(last($this->array));
    }

    // Trae el resto despues de
    public function StrAft(){
        dd(Str::after($this->text, 'Mi nombre es'));
    }

    // Trae el resto antes de
    public function StrBef(){
        dd(Str::before($this->text, 'Nicolas Chamorro'));
    }

    //trae cadena en medio
    public function StrBet(){
        dd(Str::between($this->text, 'Mi','Nicolas'));
    }
    
    //Verifica si la cadena existe
    public function StrCon(){
        dd(Str::contains($this->text, 'Nicolas'));
    }
    
    //Verifica si la cadena existe con opcion de comodin
    public function StrIs(){
        dd(Str::is($this->text, 'Nico*'));
    }

    //Agrega al final contenido siempre y cuando no exista en el fin
    public function StrFin(){
        dd(Str::finish($this->text, ' Giron'));
    }
    
     //devuelve la longitud de la cadena dada:
     public function StrLen(){
        dd(Str::length($this->text));
    }

     //trunca la cadena dada a la longitud especificada:
     public function StrLim(){
        dd(Str::limit($this->text, 15));
        // dd(Str::limit($this->text , 10 , ' ...ver mas'));
    }

    //convierte la cadena dada a minúsculas:
    public function StrLow(){
        dd(Str::lower($this->text));
    }

    //Rellena hasta cumplir la longitud:
    public function StrPB(){
        // dd(Str::padBoth('Nico',10));
        dd(Str::padBoth('Nico',10,'.'));
    }

    //Rellena hasta cumplir la longitud left:
    public function StrPBL(){
        dd(Str::padLeft('Nico',10));
        dd(Str::padLeft('Nico',10,'.'));
    }

     //Rellena hasta cumplir la longitud derecha:
     public function StrPBR(){
        dd(Str::padRight('Nico',10));
        dd(Str::padRight('Nico',10,'.'));
    }

    //convierte una cadena de palabras en singular a su forma plural, solo ingles
    public function StrPlu(){
        dd(Str::plural('user'));
    }

    //cadena aleatoria
    public function StrRan(){
        dd(Str::random(50));
    }

    //convierte una cadena de palabras en singular a su forma plural y viceversa solo ingles
    // false ignore mayusculas y minusculas
    public function StrRem(){
        dd(Str::remove('ni',$this->text, false));
    }

    // reemplaza una cadena dada dentro de la cadena:
    public function StrRep(){
        dd(Str::replaceFirst('Nicolas','Angel',$this->text));
    }

    //  reemplaza un valor dado en la cadena secuencialmente usando una matriz:
    public function StrRA(){
        $string = 'El evento empieza a las ? y termina a las ?';
        dd(Str::replaceArray('?', ['8:30', '9:00'], $string));
    }

    //convierte una cadena de palabras a singular solo en ingles
    public function StrSin(){
        dd(Str::singular('users'));
    }

     // genera un "slug" compatible con URL a partir de la cadena dada:
     public function StrSlu(){
        dd(Str::slug($this->text));
    }

     public function StrSta(){
        dd(Str::start($this->text,'agregando al inicio => '));
    }   

     //  devolverá truesi la cadena comienza con alguno de los valores dados:
     public function StrSW(){
        dd(Str::startsWith($this->text,['Mi','Hola','buenos']));
    }   

    // devuelve la parte de la cadena especificada por los parámetros de inicio;
    public function StrSub(){
        dd(Str::substr($this->text,3));
    }   

    // devuelve el número de apariciones de un valor dado en la cadena dada:
    public function StrSC(){
        dd(Str::substrCount($this->text, 'nombre'));
    }   


    // método convierte la cadena dada a formato titulo de libro:
    public function StrTit(){
        dd(Str::title($this->text));
    }   

    
    // método devuelve la cadena dada con el primer carácter en mayúscula:
        public function StrUF(){
            dd(Str::ucfirst($this->text));
        }  

        
    // convierte la cadena dada a mayúsculas:
    public function StrUpp(){
        dd(Str::upper($this->text));
    }  

    // Genera RUTA
    public function ruta(){
        dd(action(HelpersLivewire::class));
    }  

      // Genera URL
      public function asset(){
        dd(asset('img/blogs'));
    }  

    // Genera ruta con nombre
    public function route(){
        dd(route('contact'));
    }  

    // Genera url simple
    public function url(){
        dd(url('personas/index'));
    }  

    //corta el codigo con un html
    public function abort(){
        abort(403, 'No estas autroizado');
    }

    //si esta vacio true
    public function blank(){
        $name = null;
        dd(blank($name));
    }

    //si esta vacio false
    public function  filled(){
        $name = null;
        dd(filled($name));
    }

   
}

