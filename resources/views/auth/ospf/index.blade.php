@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{route('ospf.create')}}" class="btn btn-outline-primary float-right"><i
                                    class="fa fa-plus" aria-hidden="true"></i> Routing OSPF Network</a>
                        Routing ospf Network
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">Dibawah adalah daftar Routing OSPF Network yang ada pada MikroTik
                        Anda.</h6>
                </div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('fail'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {!! session('fail') !!}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Network</th>
                            <th>Area</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ospfNetworks as $server)
                            <tr>
                                <td>{{ $server['.id'] }}</td>
                                <td>{{ $server['network'] }}</td>
                                <td>{{ $server['area'] }}</td>
                                <td>
                                    <form onsubmit="event.preventDefault(); confirmDeleteForm(this)"
                                          class="btn-group btn-group-sm" role="group" aria-label="..."
                                          action="{{ route('ospf.destroy', $server['.id']) }}" method="POST">
                                        <a data-toggle="tooltip" title="Lihat rincian"
                                           href="{{ route('ospf.show', $server['.id']) }}"
                                           class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                        <a data-toggle="tooltip" title="Edit data"
                                           href="{{ route('ospf.edit', $server['.id']) }}"
                                           class="btn btn-dark"><i class="fa fa-edit"
                                                                   aria-hidden="true"></i></a>
                                        <button data-toggle="tooltip" title="Hapus data"
                                                type="submit" class="btn btn-danger"><i class="fa fa-trash"
                                                                                        aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar client <label
                                id="ospf-name"></label></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th>Address</th>
                        <th>MAC Address</th>
                        <th>Hostname</th>
                    </tr>
                    </thead>
                    <tbody id="tbody-ospf">
                    </tbody>
                </table>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                placement: 'bottom'
            })
        });

        function showClients(name) {
            // clients = JSON.parse($clients);
            $("#ospf-name").text(name);
            tbody = document.getElementById("tbody-ospf");
            let listClients = clients[name];
            console.log(listClients);
            tbody.childNodes.forEach((child) => tbody.removeChild(child));
            if (listClients !== undefined) {
                listClients.forEach((item) => {
                    let newRow = tbody.insertRow(tbody.childElementCount);
                    newRow.insertCell(0).innerText = item.address;
                    newRow.insertCell(1).innerText = item['mac-address'];
                    newRow.insertCell(2).innerText = item['host-name'];
                });
                $("#exampleModal").modal('show');
            }
        }

        function confirmDeleteForm(form) {
            swal("Apakah anda yakin ingin menghapus data Routing OSPF?", {
                buttons: {
                    cancel: "Kembali",
                    yes: {
                        text: "Ya",
                        value: "yes",
                    },
                },
            })
                .then((value) => {
                    if (value === 'yes') form.submit();
                });
        }
    </script>
@endsection