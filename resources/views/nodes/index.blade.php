@extends('nodes.layout')
 
@section('content')
   
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
