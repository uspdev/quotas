@extends('master')

@section('title', 'Fila')

@section('content')

    <style>

        #actions
        {
            display: flex;
            justify-content: start;
        }

        #i-ban
        {
            margin-left: 80%;
        }

        button
        {
            background-color: transparent; 
            border: none;
        }

    </style>

	<div class="card-header">
		<h4><b>Fila de 
            @if ($auth)
                autorização de
            @endif
            {{ $name }}</b>
        </h4>
	</div>
    <br>
    @if(!$auth)
    @include('printings.partials.printings_quantities')
    <br>
    {{ $printings->links() }}
    @endif
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
                    @include('fila.partials.fila_header')
                    @if ($auth)
                        @can('admin')
                        <th width="14%">Foto</th>
                        <th width="14%">Ações</th>
                        @endcan
                    @endif
				</tr>
			</thead>
			<tbody>
				@forelse ($printings as $printing)
					<tr>
                        @include('fila.partials.fila_body')
                        @if ($auth)
                            @can('admin')
                               <td> 
                                   <img src="data:image/png;base64, {{ $fotos[$printing->user] }} "
                                   width="170px" height="220px"/>
                                 </td>
                                <td>
                                    <div id="actions">
                                        <form>
                                        <a href="/printings/action/{{ $printing->id }}?action=authorized" onclick="return confirm('Tem certeza que deseja autorizar?');"><i class="fas fa-check"></i></a>
                                        <a href="/printings/action/{{ $printing->id }}?action=cancelled" onclick="return confirm('Tem certeza que deseja cancelar?');"><i class="fas fa-ban"></i></a>
                                        </form>
                                    </div>
                                </td>
                            @endcan 
                        @endif
					</tr>
                @empty
                    <tr>
                        <td colspan= @if ($auth) "11" @else "10" @endif>Não há impressões</td>
                    </tr>
				@endforelse
			</tbody>
		</table>
    </div>

    @can('admin')
		@include('printings.historico')
    @endcan

@endsection