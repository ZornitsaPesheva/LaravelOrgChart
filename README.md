<p align="center">
OrgChart JS with Lavarel
</p>

## Download and run the project:
Clone the progect:
```
git clone https://github.com/ZornitsaSerbezova/LaravelOrgChart.git
```

cd into your project:
```
cd LaravelOrgChart
```

Install Composer Dependencies:
```
composer install
```

Create a copy of your .env file:
```
cp .env.example .env
```

Generate an app encryption key:
```
php artisan key:generate
```

Edit the **.env** file replacing these rows:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
with this one:
```
DB_CONNECTION=sqlite
```

In **database** folder create an empty database file **database.sqlite** for our application.

Do the migtation:
```
php artisan migrate
```

Run the project:
```
php artisan serve
```


## Create plroject tutorial:

```
laravel new chart
```

cd into your project:
```
cd chart
```

Laravel comes with default **.env** file at root.
In the file you will find code like below:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Replace above all 6 lines with below 1 line - i.e Change the db_connection’s value to sqlite and delete rest of the db lines like below:

```
DB_CONNECTION=sqlite
```

Now in your database directory, create a file – **database.sqlite**

Now create a migration file:

```
php artisan make:migration create_nodes_table --create=nodes
```
You will find your newly created migration in **/database/migrations** folder

Now let’s edit this file to add **pid**:
```
Schema::create('nodes', function (Blueprint $table) {
            $table->id();
            $table->integer('pid')->nullable();
            $table->timestamps();
        });
```
And do the migration:
```
php artisan migrate
```
Now, let’s edit **routes/web.php**. Add these lines:
```
use App\Http\Controllers\NodeController;
Route::resource('nodes', NodeController::class);
```
Add controller and model:
```
php artisan make:controller NodeController --resource --model=Node
```
press enter on the question 

Edit **app/Http/Controllers/NodeController.php** as follows:
```
<?php

namespace App\Http\Controllers;

use App\Models\Node;
use Illuminate\Http\Request;

class NodeController extends Controller
{

    public function index()
    {

       $nodes = Node::get();

       return view('nodes.index', ['nodes' => $nodes]);

    }
    public function store(Request $request)
    {

        $request->validate([
            'id' => 'required',

        ]);
    
        Node::create($request->all());

        return redirect()->route('nodes.index')
                        ->with('success','Node created successfully.');
    }

}
```
Change **app/Models/Node.php** as follows:
```
class Node extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'pid'
    ];
}
```
Now, in **/resources/views** folder create folder **nodes** and these files in it:

**layout.blade.php**
```
<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 CRUD Application - ItSolutionStuff.com</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <script src="https://balkangraph.com/js/latest/OrgChart.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        html, body {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            overflow: hidden;
        }

        #tree {
            width: 100%;
            height: 100%;
        }

        .field_0 {
            font-family: Impact;
        }
    </style>
</head>
<body>
  
<div style="height: 100%">
    @yield('content')
</div>
   
</body>
</html>
```
**index.blade.php**
```
@extends('nodes.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Example from scratch - ItSolutionStuff.com</h2>
            </div>
            <!-- <div class="pull-right">
                <a class="btn btn-success" href="{{ route('nodes.create') }}"> Create New Node</a>
            </div> -->
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   

    <div id="tree">
        </div>
    <script>
        var chart = new OrgChart(document.getElementById("tree"), {
            enableDragDrop: true,
            nodeMenu: {
                add: { text: "Add" }
            },
            nodeBinding: {
                field_0: "id"
            }
        });
      
        chart.on('add', function (sender, node) {
            node.id = new Date().valueOf();
            node.pid = parseInt(node.pid);
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:"{{ route('nodes.store') }}",
                data: node,
                success:function(data){
                    sender.addNode(node); // node is adding
                }
            });
            return false;
        });
   
        var app = @json($nodes);
        chart.load(app);
    </script>
      
@endsection
```
Now you can start the project:
```
php artisan serve
```
