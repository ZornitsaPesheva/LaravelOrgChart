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
                edit: { text: "Edit" },
                add: { text: "Add" },
                remove: { text: "Remove" }
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
