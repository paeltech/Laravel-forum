 @extends('layouts.app')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading">Channels</div>

                <div class="panel-body">
                    <table class="table table-hover">
                    	<th>
                    		Name
                    	</th>
                    	<th>
                    		Edit
                    	</th>
                    	<th>
                    		Delete
                    	</th>
                    	<tbody>
                    		@foreach($channels as $channel) 
                    			<tr>
                    				<td>{{ $channel->title }}</td>
                    				<td>
                    					<a href="{{ route('channels.edit', ['channel' => $channel->id ]) }}" class="btn btn-success">Edit</a>
                    				</td>
                    				<td>
                    					<form action="{{ route('channels.destroy', ['channel' => $channel->id ]) }}" method="POST">
                    						{{ csrf_field() }}
                    						{{ method_field('DELETE') }}
                    						
                    						<button class="btn btn-danger" type="submit">Delete</button> 
                    					</form>
                    					
                    				</td>
                    			</tr>
                    		@endforeach
                    	</tbody>
                    </table>
                </div>
            </div>

@endsection
