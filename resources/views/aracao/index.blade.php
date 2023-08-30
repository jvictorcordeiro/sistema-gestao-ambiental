<x-app-layout>
    @section('content')
        <div class="container-fluid" style="padding-top: 3rem; padding-bottom: 6rem; padding-left: 10px; padding-right: 20px">
            <div class="form-row justify-content-between">
                <div class="col-md-9">
                    <div class="form-row d-flex justify-content-between align-items-center">
                        <div class="col-md-8">
                            <h4 class="card-title">Aração</h4>
                        </div>
                        <div class="col-xs-4" style="margin-left: -10px;">
                            <a title="Solicitar serviço" class="ml-2" href="{{ route('aracao.create') }}">
                                <img class="icon-licenciamento" src="{{ asset('img/Grupo 1666.svg') }}" style="height: 35px" alt="Icone de solicitação de serviço">
                            </a>
                            {{-- <a title="Gerar Pedidos" class="ml-2" href="{{ route('aracao.gerarPedidosAracao') }}">
                                <img class="icon-licenciamento" src="{{ asset('img/gerar_pedido.svg') }}" style="height: 35px" alt="Icone de gerar solicitações de serviço">
                            </a> --}}
                        </div>
                    </div>
                    @can('isSecretarioOrBeneficiario', \App\Models\User::class)
                        <form action="{{ route('aracao.index') }}" method="get">
                            @csrf
                            <div class="form-row mb-3">
                                <div class="col-md-7">
                                    <input type="text" class="form-control w-100" name="buscar" placeholder="Digite o nome ou o código do Beneficiário">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn" style="background-color: #00883D; color: white;">Buscar</button>
                                </div>
                            </div>
                        </form>
                    @endcan
                    <div div class="form-row">
                        @if (session('success'))
                            <div class="col-md-12" style="margin-top: 5px;">
                                <div class="alert alert-success" role="alert">
                                    <p>{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="form-row">
                        @if (session('error'))
                            <div class="col-md-12" style="margin-top: 5px;">
                                <div class="alert alert-danger" role="alert">
                                    <p>{{ session('error') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <div class="tab-content tab-content-custom" id="myTabContent">
                                <div class="tab-pane fade show active" id="aracao" role="tabpanel" aria-labelledby="aracao-tab">
                                     @if ($aracao->isEmpty())
                                        <div class="alert alert-info" role="alert">
                                            Nenhuma aração correspondente cadastrada.
                                        </div>
                                        @else
                                        <div class="table-responsive">
                                            <table class="table mytable" id="aracao_table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Beneficiário</th>
                                                        <th scope="col">Código</th>
                                                        <th scope="col">Cultura</th>
                                                        <th scope="col">Localização</th>
                                                        <th scope="col">Hectares</th>
                                                        <th scope="col">Horas</th>
                                                        <th scope="col">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($aracao as $item)
                                                        <tr>
                                                            <td>{{ $item->beneficiario->nome }}</td>
                                                            <td>{{ $item->beneficiario->codigo }}</td>
                                                            <td>{{ $item->cultura }}</td>
                                                            <td>{{ $item->ponto_localizacao }}</td>
                                                            <td>{{ $item->quantidade_ha }}</td>
                                                            <td>{{ $item->quantidade_horas }}</td>
                                                            <td>
                                                                <a href="{{ route('aracao.show', ['id' => $item->id]) }}">
                                                                    <img class="icon-licenciamento" width="20px;" src="{{ asset('img/Visualizar.svg') }}" alt="Visualizar Aração" title="Visualizar Aração">
                                                                </a>
                                                                <a href="{{ route('aracao.edit', ['id' => $item->id]) }}">
                                                                    <img class="icon-licenciamento" width="20px;" src="{{ asset('img/edit-svgrepo-com.svg') }}" alt="Editar Aração" title="Editar Aração">
                                                                </a>
                                                                <a title="Deletar Aração" type="button" data-toggle="modal" data-target="#modalStaticDeletarAracao_{{$item->id}}">
                                                                    <img class="icon-licenciamento" src="{{ asset('img/trash-svgrepo-com.svg') }}" alt="Icone de deletar Aração">
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="col-md-12 shadow-sm p-2 px-3" style="background-color: #ffffff; border-radius: 0.5rem; margin-top: 5.2rem;">
                        <div style="font-size: 21px;" class="tituloModal">
                            Legenda
                        </div>
                        <div class="mt-2 borda-baixo"></div>
                        <ul class="list-group list-unstyled">
                            <li>
                                @can('isSecretarioOrBeneficiario', \App\Models\User::class)
                                    <div title="Visualizar Aração" class="d-flex align-items-center my-1 pt-0 pb-1">
                                        <img class="icon-licenciamento align-middle" width="20" src="{{ asset('img/Visualizar.svg') }}" alt="Visualizar Aração">
                                        <div style="font-size: 15px;" class="align-middle mx-3">
                                            Visualizar Aração
                                        </div>
                                    </div>
                                    <div title="Editar Aração"class="d-flex align-items-center my-1 pt-0 pb-1">
                                        <img class="icon-licenciamento align-middle" width="20" src="{{ asset('img/edit-svgrepo-com.svg') }}" alt="Editar Aração">
                                        <div style="font-size: 15px;" class="align-middle mx-3">
                                            Editar Aração
                                        </div>
                                    </div>
                                    <div title="Excluir Aração" class="d-flex align-items-center my-1 pt-0 pb-1">
                                        <img class="icon-licenciamento align-middle" width="20" src="{{ asset('img/trash-svgrepo-com.svg') }}" alt="Excluir Aração">
                                        <div style="font-size: 15px;" class="align-middle mx-3">
                                            Excluir Aração
                                        </div>
                                    </div>
                                @endcan
                            </li>
                        </ul>
                    </div>
                </div>
                @foreach ($aracao as $item)
                    <div class="modal fade" id="modalStaticDeletarAracao_{{$item->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #dc3545;">
                                    <h5 class="modal-title" id="staticBackdropLabel" style="color: white;">Confirmação</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="deletar-aracao-form-{{$item->id}}" method="POST" action="{{route('aracao.destroy', ['id' => $item->id])}}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        Tem certeza que deseja deletar o aração do beneficiário {{$item->beneficiario->nome}}?
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger submeterFormBotao" form="deletar-aracao-form-{{$item->id}}">Sim</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection
</x-app-layout>